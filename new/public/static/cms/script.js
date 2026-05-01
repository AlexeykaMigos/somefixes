// Функции для слайдера
function moveSliderNew(btn, direction) {
    var wrapper = btn.closest('.mycat-slider-wrapper');
    var section = wrapper.querySelector('.mycat-section');
    var viewport = wrapper.querySelector('.mycat-viewport');
    
    var cardWidth = 326; // 298px ширина + 28px gap
    if (window.innerWidth <= 768) {
        cardWidth = window.innerWidth * 0.85 + 28;
    } else if (window.innerWidth <= 1200) {
        cardWidth = 280 + 28;
    }
    
    var maxScroll = section.scrollWidth - viewport.offsetWidth;
    
    var currentPos = parseInt(section.getAttribute('data-pos')) || 0;
    currentPos += (direction * cardWidth);

    if (currentPos < 0) currentPos = 0;
    if (currentPos > maxScroll) currentPos = maxScroll;

    section.setAttribute('data-pos', currentPos);
    section.style.transform = "translateX(-" + currentPos + "px)";
}

function toggleHeart(element) {
    element.classList.toggle('active');
}

// Единый обработчик DOMContentLoaded
document.addEventListener('DOMContentLoaded', function() {
    // Переменные для мобильного меню
    const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const mobileMenuClose = document.querySelector('.mobile-menu-close');
    const menuOverlay = document.querySelector('.menu-overlay');
    const body = document.body;
    const header = document.querySelector('.cd-site-header');
    
    let lastScrollTop = 0;
    let isMenuOpen = false;
    
    // Функции управления меню
    function openMenu() {
        if (mobileMenuToggle) mobileMenuToggle.classList.add('active');
        if (mobileMenu) mobileMenu.classList.add('active');
        if (menuOverlay) menuOverlay.classList.add('active');
        body.style.overflow = 'hidden';
        isMenuOpen = true;
    }
    
    function closeMenu() {
        if (mobileMenuToggle) mobileMenuToggle.classList.remove('active');
        if (mobileMenu) mobileMenu.classList.remove('active');
        if (menuOverlay) menuOverlay.classList.remove('active');
        body.style.overflow = '';
        isMenuOpen = false;
    }
    
    // Открытие/закрытие меню
    if (mobileMenuToggle) {
        mobileMenuToggle.addEventListener('click', function(e) {
            e.stopPropagation();
            if (!isMenuOpen) {
                openMenu();
            } else {
                closeMenu();
            }
        });
    }
    
    // Закрытие меню
    if (mobileMenuClose) {
        mobileMenuClose.addEventListener('click', closeMenu);
    }
    
    if (menuOverlay) {
        menuOverlay.addEventListener('click', closeMenu);
    }
    
    // Закрытие меню при клике на ссылки
    const mobileLinks = document.querySelectorAll('.mobile-nav .nav-link, .mobile-contact-btn');
    mobileLinks.forEach(link => {
        link.addEventListener('click', function() {
            setTimeout(closeMenu, 300);
        });
    });
    
    // Закрытие меню на Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && isMenuOpen) {
            closeMenu();
        }
    });
    
    // Закрытие меню при изменении ориентации
    window.addEventListener('orientationchange', function() {
        if (isMenuOpen) {
            closeMenu();
        }
    });
    
    // Скрытие/показ шапки при скролле
    window.addEventListener('scroll', function() {
        if (window.innerWidth <= 992 && !isMenuOpen && header) {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            
            if (scrollTop > lastScrollTop && scrollTop > 100) {
                header.classList.add('header-hide');
            } else {
                header.classList.remove('header-hide');
            }
            
            lastScrollTop = scrollTop;
        }
    });
    
    // Инициализация слайдеров
    function initSliders() {
        const sliders = document.querySelectorAll('.mycat-section');
        sliders.forEach(slider => {
            if (window.innerWidth <= 768) {
                slider.setAttribute('data-pos', '0');
                slider.style.transform = "translateX(0)";
            }
        });
        
        // Закрытие меню при переходе на большой экран
        if (window.innerWidth > 992 && isMenuOpen) {
            closeMenu();
        }
    }
    
    initSliders();
    window.addEventListener('resize', initSliders);
    
    // Свайпы для мобильного меню
    if (mobileMenu) {
        let startX = 0;
        let startY = 0;
        
        mobileMenu.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            startY = e.touches[0].clientY;
        });
        
        mobileMenu.addEventListener('touchmove', function(e) {
            if (!isMenuOpen) return;
            
            const currentX = e.touches[0].clientX;
            const currentY = e.touches[0].clientY;
            const diffX = startX - currentX;
            const diffY = startY - currentY;
            
            // Если свайп по горизонтали больше, чем по вертикали, предотвращаем скролл
            if (Math.abs(diffX) > Math.abs(diffY)) {
                e.preventDefault();
            }
        });
        
        mobileMenu.addEventListener('touchend', function(e) {
            if (!isMenuOpen) return;
            
            const endX = e.changedTouches[0].clientX;
            const diffX = startX - endX;
            
            // Закрытие меню свайпом вправо
            if (diffX < -100) {
                closeMenu();
            }
        });
    }
    
    // Свайпы для слайдеров
    const sliders = document.querySelectorAll('.mycat-viewport');
    sliders.forEach(slider => {
        let startX = 0;
        let isDragging = false;
        
        slider.addEventListener('touchstart', function(e) {
            startX = e.touches[0].clientX;
            isDragging = true;
        });
        
        slider.addEventListener('touchmove', function(e) {
            if (!isDragging) return;
            e.preventDefault();
        });
        
        slider.addEventListener('touchend', function(e) {
            if (!isDragging) return;
            isDragging = false;
            
            const endX = e.changedTouches[0].clientX;
            const diff = startX - endX;
            const wrapper = this.closest('.mycat-slider-wrapper');
            
            // Определяем направление свайпа
            if (Math.abs(diff) > 50) {
                if (diff > 0) {
                    // Свайп влево - двигаем вправо
                    const nextBtn = wrapper.querySelector('.arrow-right');
                    if (nextBtn) moveSliderNew(nextBtn, 1);
                } else {
                    // Свайп вправо - двигаем влево
                    const prevBtn = wrapper.querySelector('.arrow-left');
                    if (prevBtn) moveSliderNew(prevBtn, -1);
                }
            }
        });
    });
    
    // Оптимизация для быстрых кликов
    const buttons = document.querySelectorAll('button, a');
    buttons.forEach(button => {
        button.addEventListener('touchstart', function() {
            this.style.transform = 'scale(0.98)';
        });
        
        button.addEventListener('touchend', function() {
            this.style.transform = '';
        });
        
        button.addEventListener('touchcancel', function() {
            this.style.transform = '';
        });
    });
    
    // Предотвращение зума при двойном тапе
    let lastTouchTime = 0;
    document.addEventListener('touchend', function(event) {
        const currentTime = new Date().getTime();
        const timeDiff = currentTime - lastTouchTime;
        
        if (timeDiff < 300 && timeDiff > 0) {
            event.preventDefault();
        }
        
        lastTouchTime = currentTime;
    }, { passive: false });
    
    // Аккордеон для FAQ
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const answer = item.querySelector('.faq-answer');
        if (!answer) return;
        
        answer.style.transition = 'max-height 0.3s ease, padding 0.3s ease';
        
        // Устанавливаем начальные значения
        if (item.open) {
            answer.style.maxHeight = answer.scrollHeight + 'px';
        } else {
            answer.style.maxHeight = '0';
            answer.style.overflow = 'hidden';
        }
        
        item.addEventListener('toggle', function() {
            if (this.open) {
                answer.style.maxHeight = answer.scrollHeight + 'px';
            } else {
                answer.style.maxHeight = '0';
            }
        });
        
        // Закрытие других элементов при открытии одного
        item.addEventListener('click', function() {
            if (this.hasAttribute('open')) {
                return;
            }
            
            faqItems.forEach(otherItem => {
                if (otherItem !== this && otherItem.hasAttribute('open')) {
                    otherItem.removeAttribute('open');
                    const otherAnswer = otherItem.querySelector('.faq-answer');
                    if (otherAnswer) {
                        otherAnswer.style.maxHeight = '0';
                    }
                }
            });
        });
    });
});

document.addEventListener('DOMContentLoaded', function() {
    // Мобильное меню
    const menuToggle = document.querySelector('.mobile-menu-toggle');
    const mobileMenu = document.querySelector('.mobile-menu');
    const menuOverlay = document.querySelector('.menu-overlay');
    const menuClose = document.querySelector('.mobile-menu-close');

    function toggleMenu() {
        mobileMenu.classList.toggle('active');
        menuOverlay.classList.toggle('active');
        document.body.classList.toggle('no-scroll');
    }

    if(menuToggle) {
        menuToggle.addEventListener('click', toggleMenu);
        menuClose.addEventListener('click', toggleMenu);
        menuOverlay.addEventListener('click', toggleMenu);
    }
});
// Функция, которая следит за прокруткой страницы
function reveal() {
    var reveals = document.querySelectorAll(".reveal");
    for (var i = 0; i < reveals.length; i++) {
        var windowHeight = window.innerHeight;
        var elementTop = reveals[i].getBoundingClientRect().top;
        var elementVisible = 100; // Элемент появится, когда до него останется 100px

        if (elementTop < windowHeight - elementVisible) {
            reveals[i].classList.add("visible");
        }
    }
}

// Слушаем событие скролла
window.addEventListener("scroll", reveal);
// Запускаем проверку сразу при загрузке
document.addEventListener("DOMContentLoaded", reveal);

// Открытие модалки
const modal = document.getElementById("contactModal");
const btns = document.querySelectorAll(".early-access-btn, .mycat-btn"); // Все кнопки
const span = document.querySelector(".close-modal");

if (btns && btns.length && modal) {
    btns.forEach(btn => {
        btn.onclick = function(e) {
            e.preventDefault();
            modal.style.display = "block";
        }
    });
}

if (span && modal) {
    span.onclick = () => modal.style.display = "none";
}
if (modal) {
    window.addEventListener('click', (event) => { if (event.target == modal) modal.style.display = "none"; });
}

// Отправка формы (AJAX)
const kittenForm = document.getElementById('kittenForm');
if (kittenForm) {
    kittenForm.onsubmit = async function(e) {
        e.preventDefault();
        const status = document.getElementById('formStatus');
        status.innerHTML = "Sending...";

        let formData = new FormData(this);
        formData.append('action', 'send_kitten_mail');

        let response = await fetch('/wp-admin/admin-ajax.php', {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            status.innerHTML = "Success! We will contact you.";
            setTimeout(() => { if (modal) modal.style.display = "none"; status.innerHTML = ""; }, 2000);
        } else {
            status.innerHTML = "Error. Please try again.";
        }
    };
}
