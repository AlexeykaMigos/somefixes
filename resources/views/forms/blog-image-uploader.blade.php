<div
    x-data="{
        uploading: false,
        progress: 0,
        preview: null,
        errMsg: null,

        setImageUrl(url) {
            // Method 1: Livewire 3 JS API
            try {
                const el = document.querySelector('[wire\\:id]');
                if (el) {
                    const comp = window.Livewire.find(el.getAttribute('wire:id'));
                    if (comp) { comp.set('data.image_url', url); return; }
                }
            } catch(e) {}

            // Method 2: Alpine $wire magic
            try { $wire.set('data.image_url', url); return; } catch(e) {}

            // Method 3: find the input and fire native input event
            const inputs = document.querySelectorAll('input[type=text]');
            for (const inp of inputs) {
                if (inp.id && inp.id.toLowerCase().includes('image_url')) {
                    const setter = Object.getOwnPropertyDescriptor(HTMLInputElement.prototype, 'value').set;
                    setter.call(inp, url);
                    inp.dispatchEvent(new Event('input', {bubbles:true}));
                    inp.dispatchEvent(new Event('change', {bubbles:true}));
                    return;
                }
            }
        },

        upload(event) {
            const file = event.target.files[0];
            if (!file) return;
            this.uploading = true;
            this.errMsg = null;
            this.progress = 0;

            const form = new FormData();
            form.append('image', file);
            const tokenMeta = document.head.querySelector('meta[name=csrf-token]');
            if (tokenMeta) form.append('_token', tokenMeta.content);

            const xhr = new XMLHttpRequest();
            xhr.upload.addEventListener('progress', (e) => {
                if (e.lengthComputable) this.progress = Math.round(e.loaded / e.total * 100);
            });
            xhr.addEventListener('load', () => {
                this.uploading = false;
                this.progress = 0;
                if (xhr.status === 200) {
                    const data = JSON.parse(xhr.responseText);
                    this.preview = data.url;
                    this.setImageUrl(data.url);
                } else {
                    this.errMsg = 'Upload failed (status ' + xhr.status + '). Try pasting URL manually.';
                }
            });
            xhr.addEventListener('error', () => {
                this.uploading = false;
                this.errMsg = 'Network error. Try pasting URL manually.';
            });
            xhr.open('POST', '/admin/blog-image-upload');
            xhr.send(form);
        }
    }"
    class="space-y-3"
>
    <p class="text-sm font-medium text-gray-700 dark:text-gray-300">Upload Photo</p>

    <label
        class="inline-flex items-center gap-2 cursor-pointer px-4 py-2 rounded-lg text-sm font-medium text-white transition-colors"
        :class="uploading ? 'bg-gray-400 cursor-not-allowed' : 'bg-primary-600 hover:bg-primary-500'"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
        </svg>
        <span x-text="uploading ? 'Uploading ' + progress + '%...' : 'Choose Photo'"></span>
        <input type="file" accept="image/*" class="hidden" x-on:change="upload($event)" :disabled="uploading">
    </label>

    <div x-show="uploading" class="w-full bg-gray-200 rounded-full h-2">
        <div class="bg-primary-600 h-2 rounded-full transition-all duration-200" :style="'width:' + progress + '%'"></div>
    </div>

    <p x-show="errMsg" x-text="errMsg" class="text-sm text-red-600"></p>

    <div x-show="preview" class="mt-2">
        <img :src="preview" alt="Preview" class="max-h-48 rounded-lg border border-gray-200 dark:border-gray-700 object-cover">
        <p class="text-xs text-gray-500 mt-1">Uploaded. URL filled automatically in the field below.</p>
    </div>
</div>
