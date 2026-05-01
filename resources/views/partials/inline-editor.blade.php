{{-- Inline editor / saved edits applier. Include at the end of <body> on every frontend page. --}}
@php
    $editsJson = collect($settings ?? [])->filter(fn($v, $k) => str_starts_with($k, 'edit_'))->toArray();
    $isAdmin = \Illuminate\Support\Facades\Auth::check();
@endphp

<style>
    [data-cd-editable="true"] {
        cursor: text;
        transition: background-color 0.2s, outline 0.2s;
    }
    [data-cd-editable="true"]:hover {
        background-color: rgba(239, 163, 154, 0.18);
        outline: 1px dashed rgba(239, 163, 154, 0.6);
        outline-offset: 2px;
    }
    [data-cd-editable="true"]:focus {
        outline: 2px dashed #EFA39A !important;
        background-color: rgba(255, 255, 255, 0.6) !important;
    }
    @if($isAdmin)
    .cd-admin-toolbar {
        position: fixed; top: 0; left: 0; right: 0;
        background: #2d3748; color: white; padding: 8px 20px;
        display: flex; justify-content: space-between; align-items: center;
        z-index: 99999; font-size: 14px; font-family: system-ui, -apple-system, sans-serif;
    }
    .cd-admin-toolbar a { color: #a0aec0; text-decoration: none; margin-left: 15px; }
    .cd-admin-toolbar a:hover { color: white; }
    .cd-admin-toolbar .cd-btn-save {
        background: #48bb78; color: white; padding: 5px 14px;
        border-radius: 4px; cursor: pointer; border: none; font-size: 14px;
    }
    body { padding-top: 40px !important; }
    @endif
</style>

@if($isAdmin)
<div class="cd-admin-toolbar" id="cd-admin-toolbar">
    <div>
        <strong>Admin Mode</strong>
        <a href="/admin">Dashboard</a>
        <a href="/">Home</a>
        <a href="/cms/FAQ">FAQ</a>
        <a href="/cms/Adoption">Adoption</a>
        <a href="/cms/About Us">About</a>
        <a href="/cms/Contacts">Contacts</a>
    </div>
    <div>
        <span id="cd-saving-status" style="display:none; margin-right:10px; color:#a0aec0;">Saving...</span>
        <button id="cd-save-changes" class="cd-btn-save" style="display:none;">Save Changes</button>
    </div>
</div>
@endif

<script>
(function() {
    let SAVED_EDITS = @json($editsJson);
    const IS_ADMIN = {{ $isAdmin ? 'true' : 'false' }};
    const CSRF = '{{ csrf_token() }}';
    const PAGE_PATH = window.location.pathname; // Путь текущей страницы
    
    const USER_MODIFIED = new Set();

    function getElementKey(el) {
        const path = [];
        let current = el;
        while (current && current !== document.body && current.parentNode) {
            const parent = current.parentNode;
            const siblings = Array.from(parent.children);
            const index = siblings.indexOf(current);
            path.unshift(current.tagName.toLowerCase() + '[' + index + ']');
            current = parent;
            if (path.length > 8) break;
        }
        // Добавляем PAGE_PATH в строку для хеширования, чтобы ключи были разными для разных страниц
        const raw = PAGE_PATH + '|' + path.join('>');
        let hash = 0;
        for (let i = 0; i < raw.length; i++) {
            hash = ((hash << 5) - hash) + raw.charCodeAt(i);
            hash |= 0;
        }
        return 'edit_' + Math.abs(hash).toString(36) + '_' + raw.length;
    }

    function isTextLeaf(el) {
        if (!el || !el.tagName) return false;
        if (el.closest && el.closest('#cd-admin-toolbar')) return false;
        if (el.closest && el.closest('script, style, noscript')) return false;
        if (el.childElementCount !== 0) return false;
        const text = (el.textContent || '').trim();
        if (text.length === 0) return false;
        if (text.length > 2000) return false;
        return true;
    }

    function applySavedEdits() {
        if (!SAVED_EDITS || Object.keys(SAVED_EDITS).length === 0) return;
        const nodes = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, a, li, button, label, strong, em, blockquote, div, small, b, i');
        nodes.forEach(el => {
            if (document.activeElement === el) return;
            if (!isTextLeaf(el)) return;
            
            const key = getElementKey(el);
            if (USER_MODIFIED.has(key)) return;

            const saved = SAVED_EDITS[key];
            if (saved !== undefined && saved !== null && el.textContent !== saved) {
                el.textContent = saved;
            }
        });
    }

    function showSaveButton() {
        const btn = document.getElementById('cd-save-changes');
        if (btn) btn.style.display = 'inline-block';
    }

    function makeEditable() {
        if (!IS_ADMIN) return;
        const nodes = document.querySelectorAll('h1, h2, h3, h4, h5, h6, p, span, a, li, button, label, strong, em, blockquote, small, b, i');
        nodes.forEach(el => {
            if (!isTextLeaf(el)) return;
            if (el.dataset.cdEditable === 'true') return;
            
            const key = getElementKey(el);
            el.setAttribute('contenteditable', 'true');
            el.setAttribute('spellcheck', 'false');
            el.dataset.cdEditable = 'true';
            el.dataset.cdKey = key;
            
            el.addEventListener('input', () => {
                USER_MODIFIED.add(key);
                showSaveButton();
            });

            el.addEventListener('keydown', (e) => {
                if (e.key === 'Enter' && !e.shiftKey && el.tagName !== 'DIV') {
                    e.preventDefault();
                    el.blur();
                }
            });
            if (el.tagName === 'A') {
                el.addEventListener('click', (e) => {
                    if (el.isContentEditable) e.preventDefault();
                });
            }
        });
    }

    async function saveAll() {
        const btn = document.getElementById('cd-save-changes');
        const status = document.getElementById('cd-saving-status');
        if (btn) btn.style.display = 'none';
        if (status) { status.style.display = 'inline'; status.textContent = 'Saving...'; }

        const editables = document.querySelectorAll('[data-cd-editable="true"]');
        const payload = [];
        editables.forEach(el => {
            const key = el.dataset.cdKey;
            if (key && USER_MODIFIED.has(key)) {
                payload.push({ key, value: el.textContent });
            }
        });

        try {
            for (const item of payload) {
                const r = await fetch('/api/save-content', {
                    method: 'POST',
                    credentials: 'same-origin',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': CSRF,
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    },
                    body: JSON.stringify(item)
                });
                if (!r.ok) throw new Error('Save failed: ' + r.status);
                SAVED_EDITS[item.key] = item.value;
                USER_MODIFIED.delete(item.key);
            }
            if (status) { status.textContent = 'Saved!'; status.style.color = '#48bb78'; }
        } catch (e) {
            console.error('[CD] Save error:', e);
            if (status) { status.textContent = 'Error: ' + e.message; status.style.color = '#f56565'; }
        }
        setTimeout(() => {
            if (status) { status.style.display = 'none'; status.style.color = '#a0aec0'; status.textContent = 'Saving...'; }
        }, 2500);
    }

    function run() {
        applySavedEdits();
        makeEditable();
    }

    let debounceTimer = null;
    function scheduleRun() {
        if (debounceTimer) clearTimeout(debounceTimer);
        debounceTimer = setTimeout(run, 150);
    }

    function start() {
        run();
        setTimeout(run, 500);

        if (!IS_ADMIN && Object.keys(SAVED_EDITS || {}).length === 0) {
            return;
        }

        const observer = new MutationObserver((mutations) => {
            let hasExternalChanges = false;
            for (let m of mutations) {
                if (m.type === 'childList') {
                    if (document.activeElement && m.target === document.activeElement) continue;
                    hasExternalChanges = true;
                    break;
                }
            }
            if (hasExternalChanges) scheduleRun();
        });
        
        observer.observe(document.body, { childList: true, subtree: true });

        if (IS_ADMIN) {
            const btn = document.getElementById('cd-save-changes');
            if (btn) btn.addEventListener('click', saveAll);
            document.addEventListener('keydown', (e) => {
                if ((e.ctrlKey || e.metaKey) && e.key === 's') {
                    e.preventDefault();
                    saveAll();
                }
            });
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', start);
    } else {
        start();
    }
})();
</script>
