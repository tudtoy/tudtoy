function disableGoogleAnalyticsUniversal() {
    // Для Universal Analytics
    if (window.ga && ga.create) {
      // Получаем все трекеры
      const trackers = ga.getAll();
      
      // Отключаем каждый найденный трекер
      trackers.forEach(tracker => {
        const trackingId = tracker.get('trackingId');
        window[`ga-disable-${trackingId}`] = true;
      });
      
      // Анонимизируем IP и отключаем рекламные функции
      ga('set', 'anonymizeIp', true);
      ga('set', 'allowAdFeatures', false);
    }
}
  
  function disableGoogleAnalyticsGA4() {
    // Для GA4 (измерение через gtag.js)
    if (window.dataLayer && window.gtag) {
      // Переопределяем gtag функцию
      window.gtag = function() {
        console.log('GA4 tracking blocked:', arguments);
      };
      
      // Очищаем dataLayer
      window.dataLayer = [];
      window.dataLayer.push = function() {
        console.log('GA4 dataLayer.push blocked:', arguments);
      };
    }
}
  
  function disableAllGoogleAnalytics() {
    disableGoogleAnalyticsUniversal();
    disableGoogleAnalyticsGA4();
    
    // Дополнительно очищаем cookies GA
    document.cookie.split(';').forEach(cookie => {
      const name = cookie.split('=')[0].trim();
      if (name.startsWith('_ga') || name.startsWith('_gid') || name.startsWith('_gat')) {
        document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=.${location.hostname};`;
      }
    });
    
    console.log('Google Analytics полностью отключен');
}  

// Функция для отключения аналитики
function disableAnalytics() {
    // Отключаем Google Analytics
    disableAllGoogleAnalytics();
    
    // Отключаем Yandex.Metrika
    if (window.ym) {
        window.disableYaMetrika = true;
        const ymScripts = document.querySelectorAll('script[src*="mc.yandex.ru"]');
        ymScripts.forEach(script => script.remove());
    }
    
    // Отключаем Facebook Pixel
    if (window.fbq) {
        window.fbq = function() { console.log('Facebook Pixel disabled by user consent'); };
    }
    
    // Отключаем Hotjar
    if (window.hj) {
        window.hj = function() { console.log('Hotjar disabled by user consent'); };
    }
    
    // Удаляем другие трекеры из localStorage
    Object.keys(localStorage).forEach(key => {
        if (key.match(/(_ga|_gid|_gat|_ym|_hj)/i)) {
            localStorage.removeItem(key);
        }
    });
    
    // Удаляем cookies аналитики
    document.cookie.split(';').forEach(cookie => {
        const name = cookie.split('=')[0].trim();
        if (name.match(/(_ga|_gid|_gat|_ym|_hj)/i)) {
            document.cookie = `${name}=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;`;
        }
    });
    
    console.log('All analytics tools have been disabled');
}

function setLastShownDate() {
    const now = new Date();
    localStorage.setItem('cookiesLastTimeChecked', now.toISOString());
}

function checkLastShownDate() {
    // Проверяем, когда в последний раз был показан баннер
    const lastShown = localStorage.getItem('cookiesLastTimeChecked');

    if (!lastShown) {
        // Если нет записи - показываем баннер (первый визит)
        window.openCookieBanner();
    } else {
        const lastShownDate = new Date(lastShown);
        const now = new Date();
        const daysPassed = Math.floor((now - lastShownDate) / (1000 * 60 * 60 * 24));
        
        if (daysPassed >= 7) {
            // Если прошло 7 или более дней - показываем снова
            window.openCookieBanner();
        }
    }
}

function initCookiesStorage() {
    let cookiesObj = localStorage.getItem('cookiePreferences');

    if (cookiesObj) {
        cookiesObj = JSON.parse(cookiesObj);

        const modal = document.querySelector('.cookies-modal');

        if (modal) {
            const toggleArray = modal.querySelectorAll('.toggle input');

            if (1 in toggleArray)
                toggleArray[1].checked = cookiesObj.analytics;
            if (2 in toggleArray)
                toggleArray[2].checked = cookiesObj.personalization;
            if (3 in toggleArray)
                toggleArray[3].checked = cookiesObj.marketing;
        }

        if (!cookiesObj.analytics) {
            disableAnalytics();
        }

        if (!cookiesObj.personalization) {
            //disablePersonalization();
        }

        if (!cookiesObj.marketing) {
            //disableMarketing();
        }
    } else {
        checkLastShownDate();
    }
}

function initCookiesModal() {
    // Элементы модального окна
    const modal = document.querySelector('.cookies-modal');
    const modalContainer = modal?.querySelector('.cookies-modal__container');
    const modalOverlay = modal?.querySelector('.cookies-modal__overlay');
    const closeBtn = modal?.querySelector('.cookies-modal__close');
    const saveBtn = modal?.querySelector('.cookies-modal__save-btn');

    if (!modal) return;
    
    // Функция для открытия модального окна
    function openModal() {
        modal.style.display = 'block';
        document.body.style.overflow = 'hidden';
        modal.setAttribute('aria-hidden', 'false');
        
        // Анимация появления
        modal.style.opacity = '0';
        modal.style.transition = 'opacity 0.3s ease';
        setTimeout(() => { modal.style.opacity = '1'; }, 10);
        
        // Фокус на первый интерактивный элемент
        closeBtn.focus();
    }

    // И в функцию closeModal:
    function closeModal() {
        modal.style.opacity = '0';
        setTimeout(() => {
            modal.style.display = 'none';
            document.body.style.overflow = '';
            modal.setAttribute('aria-hidden', 'true');
        }, 300);
    }

    // Обработчики событий
    closeBtn.addEventListener('click', closeModal);
    saveBtn.addEventListener('click', function() {
        const toggleArray = modal.querySelectorAll('.toggle input');

        const analyticsChecked = toggleArray[1].checked;
        const personalizationChecked = toggleArray[2].checked;
        const marketingChecked = toggleArray[3].checked;
        
        // Сохраняем настройки
        localStorage.setItem('cookiePreferences', JSON.stringify({
            analytics: analyticsChecked,
            personalization: personalizationChecked,
            marketing: marketingChecked
        }));

        if (typeof window.closeCookieBanner === 'function') {
            window.closeCookieBanner();
        }
        
        closeModal();
    });
    
    // Закрытие по клику вне модального окна
    modalOverlay.addEventListener('click', function(e) {
        if (e.target === modalOverlay) {
            closeModal();
        }
    });
    
    // Закрытие по Esc
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.style.display === 'block') {
            closeModal();
        }
    });

    // Триггер открытия модального окна
    document.querySelectorAll('[data-modal="cookie"]').forEach((modalTrigger) => {
        modalTrigger.addEventListener('click', () => openModal());
    });
    
    // Делаем функцию openModal доступной глобально, если нужно открывать модалку извне
    window.openCookieModal = openModal;
    window.closeCookieModal = closeModal;
}

function initCookiesBanner() {
    const banner = document.querySelector('.cookies-banner');
    const saveBtn = banner?.querySelector('.cookies-banner__accept-btn');
    const closeBtn = banner?.querySelector('.cookies-banner__close-btn');

    if (!banner) return;

    // Функция для открытия баннера
    function openBanner() {
        banner.style.display = 'block';
        banner.setAttribute('aria-hidden', 'false');
        
        // Анимация появления
        banner.style.opacity = '0';
        banner.style.transition = 'opacity 0.3s ease';
        setTimeout(() => { banner.style.opacity = '1'; }, 10);
    }

    function closeBanner() {
        banner.style.opacity = '0';
        setTimeout(() => {
            banner.style.display = 'none';
            banner.setAttribute('aria-hidden', 'true');
        }, 300);

        setLastShownDate();
    }

    function saveSettings() {
        localStorage.setItem('cookiePreferences', JSON.stringify({
            analytics: true,
            personalization: true,
            marketing: true
        }));

        closeBanner();
    }

    // Обработчик согласия с куками
    saveBtn.addEventListener('click', () => saveSettings());

    // Обработчик закрытия баннера
    closeBtn.addEventListener('click', () => closeBanner());

    // Делаем функции openBanner и closeBanner доступной глобально
    window.openCookieBanner = openBanner;
    window.closeCookieBanner = closeBanner;
}

document.addEventListener('DOMContentLoaded', function() {
    // Инициализируем баннер
    initCookiesBanner();

    // Инициализируем модальное окно
    initCookiesModal();

    // Инициализируем функцию с проверкой кук
    initCookiesStorage();
});