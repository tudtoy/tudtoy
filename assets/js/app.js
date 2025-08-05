const isMobile = document.documentElement.clientWidth < 768;
const isTablet = document.documentElement.clientWidth < 1140;

let url = new URL(document.location);
let params = url.searchParams;

const EMAIL_REGEXP = /^(([^<>()[\].,;:\s@"]+(\.[^<>()[\].,;:\s@"]+)*)|(".+"))@(([^<>()[\].,;:\s@"]+\.)+[^<>()[\].,;:\s@"]{2,})$/iu;

let modals = ['art-manager', 'feedback', 'members-club', 'support', 'cart-widget'];

function throttle(func, delay) {
    let timerFlag = null;
  
    return (...args) => {
        if (timerFlag === null) {
            func(...args);
            timerFlag = setTimeout(() => {
                timerFlag = null;
            }, delay);
        }
    };
}

let swipers = {};

function initSwipers() {
    if(isTablet) {
        swipers.catalogItems = new Swiper('.catalog-item__swiper', {
            pagination: {
                el: '.catalog-item__dots',
                type: 'bullets',
            },
        });
    }
    else {
        swipers.catalogItems = new Swiper('.catalog-item__swiper', {
            effect: 'fade',
            fadeEffect: {
                crossFade: true
            },
            pagination: {
                el: '.catalog-item__dots',
                type: 'bullets',
            },
            allowTouchMove: false
        });
    }
    

    swipers.masterpieces = new Swiper('.masterpieces__swiper', {
        freeMode: true,
        slidesPerView: 'auto',
        spaceBetween: 24,
        grabCursor: true,
        navigation: {
            prevEl: '.masterpieces__btn-control_prev',
            nextEl: '.masterpieces__btn-control_next',
        },
        breakpoints: {
            1100: {
                slidesPerView: 3,
            }
        }
    });

    swipers.news = new Swiper('.news__swiper', {
        freeMode: true,
        slidesPerView: 'auto',
        spaceBetween: 24,
        grabCursor: true,

        navigation: {
            prevEl: '.news__btn-control_prev',
            nextEl: '.news__btn-control_next',
        },
        breakpoints: {
            1100: {
                slidesPerView: 3,
            }
        }
    });

    swipers.collection = new Swiper('.collection-slider__swiper:not(.story-content-slider__swiper)', {
        spaceBetween: 24,
        grabCursor: true,
        slidesPerView: 'auto',
        slidesPerGroup: 1,

        navigation: {
            nextEl: '.collection-slider__next-btn',
        },

        breakpoints: {
            768: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            }
        }
    })

    swipers.collectionContent = new Swiper('.story-content-slider__swiper', {
        spaceBetween: 24,
        grabCursor: true,
        slidesPerView: 1.15,
        slidesPerGroup: 1,

        navigation: {
            prevEl: '.collection-slider__prev-btn',
            nextEl: '.collection-slider__next-btn',
        },

        breakpoints: {
            768: {
                slidesPerView: 2,
                slidesPerGroup: 2,
            }
        }
    })

    swipers.collectionContent.on('activeIndexChange', function () {
        const newText = document.querySelectorAll('.story-content-slider__swiper .swiper-slide')[swipers.collectionContent.activeIndex].getAttribute('data-text')

        document.querySelector('.story-content-slider .collection-slider__slide-text').innerHTML = newText
    });

    const updateBtn = document.querySelector('.story-content-slider .collection-slider__update-btn')

    if (updateBtn) {
        updateBtn.addEventListener('click', () => {
            swipers.collectionContent.slideTo(0, 375);
        })
    }

    swipers.fullscreen = new Swiper('.fullscreen-slider__swiper', {
        slidesPerView: 1,
        loop: true,
        effect: 'fade',
        autoplay: {
            delay: 5000,
        },
        pagination: {
            el: '.fullscreen-slider__pagination',
            type: 'bullets',
            renderBullet: function (index, className) {
                return '<span class="' + className + '"><span class="fullscreen-slider__pagination-fill"></span></span>';
            }
        },
        navigation: {
            prevEl: '.fullscreen-slider__prev',
            nextEl: '.fullscreen-slider__next',
        },
        on: {
            autoplayTimeLeft: fullscreenSliderAutoplayHandler
        }
    })

    swipers.productDetailThumbs = new Swiper('.product-detail__swiper-thumbs', {
        direction: 'horizontal',
        slidesPerView: 'auto',
        spaceBetween: 0,
        freeMode: true,
        breakpoints: {
            768: {
                direction: 'vertical',
                slidesPerView: 6,
                spaceBetween: 12,
            }
        }
    })

    swipers.productDetail = new Swiper('.product-detail__swiper', {
        slidesPerView: 1,
        thumbs: {
            swiper: swipers.productDetailThumbs
        },
        navigation: {
            prevEl: '.product-detail__swiper-nav-button_prev',
            nextEl: '.product-detail__swiper-nav-button_next',
        }, 
    })

    if(isMobile) {
        swipers.variableGrids = new Swiper('.variable-grid', {
            slidesPerView: 'auto',
            freeMode: true,
            spaceBetween: 24,
            navigation: {
                prevEl: '.variable-grid__nav_prev',
                nextEl: '.variable-grid__nav_next',
            },
        })
    }
    else {
        swipers.variableGrids = new Swiper('.variable-grid_many', {
            slidesPerView: 4,
            spaceBetween: 24,
            navigation: {
                prevEl: '.variable-grid__nav_prev',
                nextEl: '.variable-grid__nav_next',
            },
        })
    }

    swipers.insideBox = new Swiper('.inside__swiper', {
        slidesPerView: 'auto',
        freeMode: false,
        spaceBetween: 24,
        navigation: {
            prevEl: '.inside__nav_prev',
            nextEl: '.inside__nav_next',
        },
        breakpoints: {
            768: {
                slidesPerView: 4,
            }
        }
    })

    swipers.productExplore = new Swiper('.product-explore__swiper', {
        slidesPerView: 'auto',
        spaceBetween: 24,
        autoplay: {
            delay: 3000,
        },
        speed: 2000,
        slidesPerGroup: 1,
        loop: true,
        loopAddBlankSlides: false,
        breakpoints: {
            768: {
                slidesPerGroup: 2,
            }
        }
    })

    const ownContentElem = document.querySelector('.own__content');

    if (ownContentElem && ownContentElem.classList.contains('swiper')) {
        swipers.own = new Swiper(ownContentElem, {
            slidesPerView: 'auto',
            spaceBetween: 24,
            navigation: {
                prevEl: '.own__nav_prev',
                nextEl: '.own__nav_next',
            },
            breakpoints: {
                768: {
                    slidesPerView: 'auto',
                }
            }
        })
    }

    swipers.similarProducts = new Swiper('.similar-products__swiper', {
        slidesPerView: 'auto',
        spaceBetween: 24,
        navigation: {
            prevEl: '.similar-products__nav_prev',
            nextEl: '.similar-products__nav_next',
        },
    })

    swipers.newsDetail = new Swiper('.news-detail__swiper', {
        slidesPerView: 1,
        spaceBetween: 24,
        loop: true,
        navigation: {
            prevEl: '.news-detail__swiper-nav-button_prev',
            nextEl: '.news-detail__swiper-nav-button_next',
        },
    })

    swipers.rewards = new Swiper('.rewards__tabs', {
        slidesPerView: 'auto',
        spaceBetween: 12,
        breakpoints: {
            768: {
                slidesPerView: 4,
                spaceBetween: 24,
            }
        }
    })

    swipers.choosePromo = new Swiper('.choose-your-tud-slider__slider', {
        slidesPerView: 'auto',
        spaceBetween: 24,
        breakpoints: {
            768: {
                slidesPerView: 4,
                spaceBetween: 24,
            }
        },
        navigation: {
            prevEl: '.choose-your-tud-slider__btn-control_prev',
            nextEl: '.choose-your-tud-slider__btn-control_next',
        },
    })

    
}

function fullscreenSliderAutoplayHandler(swiper, timeLeft, percentage) {
    let paginationNode = $(swiper.pagination.el);
    let bullets = paginationNode.find('.swiper-pagination-bullet');
    let isFillBullet = true;
    bullets.each((index, bullet) => {
        if($(bullet).hasClass('swiper-pagination-bullet-active')) {
            isFillBullet = false;
            let width = (1 - percentage) * 100 + '%';
            $(bullet).removeClass('fullscreen-slider__pagination-fill-bullet');
            $(bullet).find('.fullscreen-slider__pagination-fill').css({
                width: width
            })
            return;
        }
        if(isFillBullet) {
            $(bullet).addClass('fullscreen-slider__pagination-fill-bullet');
        }
        else {
            $(bullet).removeClass('fullscreen-slider__pagination-fill-bullet');
            $(bullet).find('.fullscreen-slider__pagination-fill').css({
                width: 0
            })
        }
    })
    
}

// Переключение CatalogItem свайпера при наведении мыши
function initCatalogItemSwipe() {

    function handleMouseMove(event) {
        let currentSwiper = event.currentTarget.swiper;
        let nodeRect = currentSwiper.el.getBoundingClientRect();
        let relativeX = event.pageX - nodeRect.x;
        let relativePercent = relativeX / nodeRect.width;
        let oneSlideWidth = nodeRect.width / currentSwiper.slides.length;
        let needSlideIndex = Math.floor(relativeX / oneSlideWidth);
        
        if(currentSwiper.realIndex != needSlideIndex) {
            currentSwiper.slideTo(needSlideIndex, 10);
        }
    }

    if(swipers.catalogItems.length) {
        swipers.catalogItems.forEach(swiper => {
            swiper.el.addEventListener('mousemove', throttle(handleMouseMove, 50));
            swiper.el.addEventListener('mouseleave', (event) => {
                if(event.fromElement.classList.contains('catalog-item__swiper')) {
                    swiper.slideTo(0, 10);
                }
            })
        });
    }
}

function initCatalogItemColorSwitcher() {
    $('.catalog-item_variable').each((index, item) => {
        let slides = $(item).find('.swiper-slide');
        let swiperNode = $(item).find('.catalog-item__swiper');
        let swiper = swiperNode.get(0).swiper;
        let title = $(item).find('.catalog-item__title');
        swiper.removeAllSlides();

        let colorElems = $(item).find('.catalog-item__color-wrapper');

        colorElems.each((index, colorElem) => {
            $(colorElem).click((event) => {
                event.preventDefault();
                swiperNode.addClass('catalog-item__swiper_animation');
                setTimeout(() => {
                    swiper.removeAllSlides();
                    slides.each((index, slide) => {
                        if($(slide).attr('data-color') === $(colorElem).attr('data-color')) {
                            swiper.appendSlide(slide);
                        }
                    })
    
                    colorElems.each((index, colorElem) => {
                        $(colorElem).removeClass('catalog-item__color-wrapper_active');
                    })
    
                    $(colorElem).addClass('catalog-item__color-wrapper_active');
                    let link = $(colorElem).data('link');
                    $(swiperNode).attr('href', link);
                    $(title).attr('href', link);

                    swiperNode.removeClass('catalog-item__swiper_animation');
                }, 250);
                
            })
            if(index === 0) {
                colorElem.click();
            }
        })

        if(isTablet) {
            function switchColor() {
                colorElems.each((index, colorElem) => {
                    if($(colorElem).hasClass('catalog-item__color-wrapper_active')) {
                        colorElems[(index + 1) % colorElems.length].click();
                        return false;
                    }
                })
            }
            let timer = setInterval(switchColor, 2000);

            swiper.on('slideChange', () => {
                clearInterval(timer);
                timer = setInterval(switchColor, 2000); 
            });
        }
    })
}

function initFooterAccordeon() {
    let elem = document.querySelector('.footer__menus');
    UIkit.accordion(elem, {
        content: '> .footer__menu',
        toggle: '> .footer__menu-title'
    });
}

function initInstagramParallax() {
    let elem = document.querySelector('.instagram__gallery');
    UIkit.parallax(elem, {
        x: '100%'
    });
}

function initCatalogItemDotsToggle() {
    function showCatalogSwiperDots(swiper) {
        $(swiper.pagination.el).addClass('catalog-item__dots_active');
    }
    
    function hideCatalogSwiperDots(swiper) {
        $(swiper.pagination.el).removeClass('catalog-item__dots_active');
    }

    if(swipers.catalogItems.length) {
        swipers.catalogItems.forEach((swiper) => {
            let timerId;
            swiper.on('slideChange', () => {
                if(timerId) {
                    clearTimeout(timerId);
                }
                showCatalogSwiperDots(swiper);
                timerId = setTimeout(() => {
                    hideCatalogSwiperDots(swiper);
                }, 2000)
            });
        })
    }
}

function initAutoplayButton() {
    let button = $('.fullscreen-slider__pause');
    button.on('click', (event) => {
        if(swipers.fullscreen.autoplay.paused) {
            swipers.fullscreen.autoplay.resume();
            button.addClass('btn_white');
            button.find('svg.fullscreen-slider__pause-icon').show();
            button.find('svg.fullscreen-slider__play-icon').hide();
        }
        else {
            swipers.fullscreen.autoplay.pause();
            button.removeClass('btn_white');
            button.find('svg.fullscreen-slider__pause-icon').hide();
            button.find('svg.fullscreen-slider__play-icon').show();
        }
    })
}

function toggleSwitcher(switcherWrapper) {
    let switcher = $(switcherWrapper).find('.switcher');
    let buttons = $(switcher).find('.switcher__btn');
    let back = $(switcher).find('.switcher__back');

    $(switcherWrapper).find('.switcher__btn').each((index, button) => {
        if($(this).data('switch-button') == $(button).data('switch-button')) {

            buttons.removeClass('switcher__btn_active');
            $(this).addClass('switcher__btn_active');
            
            let rect = $(this).position();
            back.css({
                left: rect.left,
                width: $(this).innerWidth(),
            })

            $($(switcherWrapper).find('[data-switch]')).each((index, elem) => {
                if($(elem).data('switch') == $(this).data('switch-button')) {
                    $(elem).show();
                }
                else {
                    $(elem).hide();
                }
            })

            updateLockNav();
        }
    });
}

function initSwitchers() {
    let switcherWrappers = $('[data-switcher]');
    let buttons = $('.switcher__btn');
        
    buttons.on('click', function (event) {
        
        if($(this).data('switch-button-single') === undefined) {
            switcherWrappers.each((index, switcherWrapper) => {
                if($(switcherWrapper).data('switcher-single') !== undefined) {
                    return;
                }
                toggleSwitcher.call(this, switcherWrapper);
            })
        }
        else {
            let wrapper = $(this).parents('[data-switcher]');
            toggleSwitcher.call(this, wrapper);
        }
        
    })

    switcherWrappers.each((index, switcherWrapper) => {
        let switcher = $(switcherWrapper).find('.switcher');
        let buttons = $(switcher).find('.switcher__btn');
        if(buttons.length) {
            buttons.get(0).click();
        }
    })
}

function updateLockNav() {
    let navButtons = $('.inside__nav-button, .about-d__nav-button');
    navButtons.each((index, navButton) => {
        if($(navButton).hasClass('swiper-button-lock')) {
            $(navButton).parents('.inside__nav, .about-d__buttons').addClass('inside__nav_hidden');
        }
        else {
            $(navButton).parents('.inside__nav, .about-d__buttons').removeClass('inside__nav_hidden');
        }
    })
}

function initAccordeons() {
    UIkit.accordion($('.product-detail__accordeon'), {
        multiple: true,
        content: '> .product-detail__accordeon-content',
        toggle: '> .product-detail__accordeon-title'
    });

    UIkit.accordion($('.accordion__list'), {
        multiple: false,
        content: '> .accordion__elem-content',
        toggle: '> .accordion__elem-title-wrapper'
    });
}

function initAvatarSwitcher() {
    let avatarNodes = $('.product-detail__avatars .product-detail__avatar-wrapper');
    avatarNodes.on('click', function (event) {
        avatarNodes.removeClass('product-detail__avatar-wrapper_active');
        $(this).addClass('product-detail__avatar-wrapper_active');
    })

    //$(avatarNodes.get(0)).click();
}

function initSelectPlaceholder(select) {
    let placeholder = $(select).find('.input__placeholder');
    let input = $(select).find('.input');

    $(input).on('change', function (event){
        if($(this).val()) {
            $(placeholder).addClass('input__placeholder_focus text_caption-small');
            $(placeholder).removeClass('text_body-small');
        }
        else {
            $(placeholder).removeClass('input__placeholder_focus text_caption-small');
            $(placeholder).addClass('text_body-small');
        }
    })
}

function initInputPlaceholders() {
    $('.input__label').each((index, label) => {
        
        if($(label).hasClass('input-mask_disabled')) {
            return;
        }

        if($(label).hasClass('select')) {
            initSelectPlaceholder(label);
            return;
        }

        let placeholder = $(label).find('.input__placeholder');
        let input = $(label).find('.input');

        $(input).on('focus', (event) => {
            $(placeholder).addClass('input__placeholder_focus text_caption-small');
            $(placeholder).removeClass('text_body-small');
        })

        $(input).on('blur', function (event){
            if(!$(this).val()) {
                $(placeholder).removeClass('input__placeholder_focus text_caption-small');
                $(placeholder).addClass('text_body-small');
            }
        })

        if($(input).val()) {
            $(placeholder).addClass('input__placeholder_focus text_caption-small');
            $(placeholder).removeClass('text_body-small');
        }
    })
}

function initAddToCart() {
    $('.product-detail__btn').on('click', function(event) {

        if($(this).hasClass('product-detail__btn_loading') || $(this).hasClass('product-detail__btn_added')) {
            return;
        }

        let btnText = $(this).find('.product-detail__btn-text');
        $(this).addClass('product-detail__btn_loading');

        $.ajax({
            url: wp.url,
            method: 'POST',
            data: {
                action: 'addToCart',
                id: $(this).data('id'),
            },
            success: (data) => {
                data = JSON.parse(data);
                if(data.status == 'success') {
                    $(btnText).html('Item in cart');
                    $(this).removeClass('product-detail__btn_loading');
                    $(this).addClass('product-detail__btn_added');

                    updateCartIcon(data.count);

                    $('.cart-widget__products').html(data.mini_cart);

                    UIkit.modal($('#cart-widget')).show();
                    $('.sticky-product').removeClass('sticky-product_active');
                    $('.sticky-product').removeClass('sticky-product_offset');

                    $('html, body').animate({ scrollTop: $(window).scrollTop() - 50 }, 200);

                    $(document).trigger('addToCart:success', [data, $(this)]);
                }
                else {
                    console.log(data);
                }
            },
            error: (data) => {
                console.log(data);
            },
        });
    })
}

function updateCartListeners() {
    initAccordeons();
    initRemoveFromCart();
    initSelectCartItemCount();
    initCouponAjax();
}

function initRemoveFromCart() {
    $('.cart-card__remove').on('click', function(event) {
        event.preventDefault();
        $('.cart__loader').addClass('cart__loader_show');

        $.ajax({
            url: wc_order_attribution.params.ajaxurl,
            method: 'POST',
            data: {
                action: 'removeFromCart',
                cart_item_id: $(this).data('cart-item-id'),
            },
            success: (data) => {
                data = JSON.parse(data);
                if(data.status == 'success') {
                    $('.cart__content').html(data.cart_html);
                    updateCartListeners();
                    updateCartIcon(data.count);
                }
            },
            error: (data) => {
                console.log(data);
            },
        });
    })
}

function initCouponAjax() {
    $('button[name="apply_coupon"]').on('click', function(e) {
        e.preventDefault();
        var coupon_code = $('input[name="coupon_code"]').val();
        
        if (coupon_code.trim() === '') {
            $('.collectors-key-feedback').html('<div class="collectors-key-error">Please enter a key</div>');
            return;
        }

        $.ajax({
            type: 'POST',
            url: wc_cart_params.ajax_url,
            data: {
                action: 'apply_collectors_key',
                coupon_code: coupon_code,
                security: wc_cart_params.apply_coupon_nonce
            },
            success: function(response) {
                $('.collectors-key-feedback').html(response);
                if (response.indexOf('success') !== -1) {
                    $('input[name="coupon_code"]').prop('readonly', true);
                    $('#remove-coupon').removeAttr('hidden');
                    $('#apply-coupon').attr('hidden', '');
                }
                
                $('.cart-card__select-wrapper .uk-select').trigger('input');
            }
        });
    });

    // AJAX coupon remove
    $(document).on('click', '#remove-coupon', function(e) {
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: wc_cart_params.ajax_url,
            data: {
                action: 'remove_collectors_key',
                security: wc_cart_params.apply_coupon_nonce
            },
            success: function() {
                $('input[name="coupon_code"]').val('').prop('readonly', false);
                $('.collectors-key-feedback').html('');
                $('#remove-coupon').attr('hidden', '');
                $('#apply-coupon').removeAttr('hidden');
                
                $('.cart-card__select-wrapper .uk-select').trigger('input');
            }
        });
    });
}

function initSelectCartItemCount() {
    $('.cart-card__select-wrapper .uk-select').on('input', function(event) {
        let quantityData = [];
        $('.cart-card__select-wrapper .uk-select').each((index, select) => {
            quantityData.push({
                cart_item_id: $(select).data('cart-item-id'),
                quantity: $(select).val()
            })
        })
        $('.cart__loader').addClass('cart__loader_show');
        $.ajax({
            url: wc_order_attribution.params.ajaxurl,
            method: 'POST',
            data: {
                action: 'changeQuantityCart',
                quantityData: quantityData,
            },
            success: (data) => {
                data = JSON.parse(data);
                if(data.status == 'success') {
                    $('.cart__content').html(data.cart_html);
                    updateCartListeners();
                    updateCartIcon(data.count);
                }
            },
            error: (data) => {
                console.log(data);
            },
        });
    })
}

function updateCartIcon(count) {
    let cartEmpty = $('.header__cart-empty');
    let cartFull = $('.header__cart-full');
    if(count > 0) {
        cartEmpty.addClass('header__cart-hidden');
        cartFull.removeClass('header__cart-hidden');
    }
    else {
        cartEmpty.removeClass('header__cart-hidden');
        cartFull.addClass('header__cart-hidden');
    }
}

function initVerifyMask() {
    let inputs = $('.verify__input')
    $('.verify__input').each((index, input) => {
        IMask(input, {
            mask: '****-****-****',
            prepareChar: str => str.toUpperCase(),
        })
    })
}

function initVerifyForm() {
    $('.verify__form').on('submit', function (event){
        event.preventDefault();
        let button = $(this).find('.verify__btn');
        button.addClass('btn_loading');
        
        $.ajax({
            url: wp.url,
            method: 'POST',
            data: {
                action: 'verify',
                code: $(this).find('[name="code"]').val(),
            },
            success: (data) => {
                button.removeClass('btn_loading');
                data = JSON.parse(data);
                if(data.success && data.url) {
                    //window.open(data.url, '_blank');
                    window.location.href = data.url;
                }
                else {
                    $(this).addClass('verify__form_error');
                }
            },
            error: (data) => {
                console.log(data);
                $(this).addClass('verify__form_error');
            },
        });
    })
}

function initVerifyDetailForm() {
    let form = $('.verify-detail__verify');
    let successNode = $(form).find('.verify-detail__success');
    let successButtonNode = $(form).find('.verify__success');
    let errorNode = $(form).find('.verify-detail__error');
    let button = $(form).find('.verify__btn');

    form.on('submit', function(event) {
        event.preventDefault();
        button.addClass('btn_loading');

        successNode.removeClass('verify-detail__success_show');
        errorNode.removeClass('verify-detail__error_show');
        $(this).removeClass('verify-detail__verify_success');
        $(this).removeClass('verify-detail__verify_error');

        $.ajax({
            url: wp.url,
            method: 'POST',
            data: {
                action: 'verify',
                code: $(this).find('[name="code"]').val(),
            },
            success: (data) => {
                button.removeClass('btn_loading');
                data = JSON.parse(data);
                if(data.success && data.url) {
                    let newPath = data.url.split('?')[0];
                    let oldPath = url.pathname;
                    if(newPath != oldPath) {
                        window.location.href = data.url;
                        return;
                    }


                    successNode.addClass('verify-detail__success_show');
                    successButtonNode.addClass('verify__success_show');
                    button.addClass('verify__btn_hidden');
                    $(this).find('.verify-detail__res-number').text(data.number);
                    $(this).find('.verify-detail__res-timestamp').text(data.timestamp);
                    $(this).find('.verify-detail__res-code').text(data.code);
                    $(this).addClass('verify-detail__verify_success');
                }
                else {
                    $(this).addClass('verify-detail__verify_error');
                    errorNode.addClass('verify-detail__error_show');
                }
            },
            error: (data) => {
                console.log(data);
                $(this).addClass('verify-detail__form_error');
            },
        });
    });

    $('.verify-detail__verify .verify__input').on('input', function(event) {
        successButtonNode.removeClass('verify__success_show');
        button.removeClass('verify__btn_hidden');
        $(form).removeClass('verify-detail__verify_success');
    })
    
    let verifyCode = params.get("code");
    if(verifyCode) {
       $('.verify__input').val(verifyCode);
       $('.verify-detail__verify').trigger('submit');
    }
}

function initFilterStore() {
    let hiddenFilter = $('.store__filter_hidden');
    $('.store__container .store__filter').on('click', function (event){
        if($(this).hasClass('uk-active')) {
            let activeFilters = $(this).parent().find('.uk-active');

            event.preventDefault();
            event.stopPropagation();
            hiddenFilter.get(0).click();
            
            $(activeFilters).each((index, elem) => {
                if(elem != $(this).get(0)) {
                    setTimeout(() => {
                        elem.click();
                    }, 50)
                    
                }
            })
        }
    })
}

function initPhoneMask() {
    function updatePadding(iti) {
        let paddingLeft = iti.selectedDialCode.offsetWidth;
        if(paddingLeft == 0) {
            paddingLeft = 17
        }
        $(iti.telInput).css({
            paddingLeft: paddingLeft + 16
        })
    }

    $('.input-mask input').each((index, input) => {
        let iti = window.intlTelInput(input, {
            initialCountry: "us",
            strictMode: true,
            separateDialCode: true,
            
            hiddenInput: () => ({ 
                phone: "full_phone"
            }),
        });

        input.iti = iti;

        updatePadding(iti);

        input.addEventListener("countrychange", () => {
            updatePadding(iti);
            $(iti.selectedDialCode).click();
        });
    })
   
}

function setErrorCheckoutField(input, errorText) {
    input.addClass('checkout__input_error');

    let parent = input.parents('.checkout__input-label');
    parent.addClass('checkout__input-label_error');

    let errorNode = parent.find('.checkout__input-error-text');
    $(errorNode).text(errorText);
}

function initCheckoutValidation() {
    let observer = new MutationObserver(mutations => {
        mutations.forEach(mutation => {
            if(mutation.addedNodes) {
                mutation.addedNodes.forEach(node => {
                    if($(node).hasClass('woocommerce-NoticeGroup')) {
                        let links = $(node).find('a');
                        if(links.length > 0) {
                            $(links).each((index, link) => {
                                let input = $($(link).attr('href'));
                                setErrorCheckoutField(input, 'Required field');
                            });
                            $(node.remove());
                        }
                        

                        if($(node).text().trim() == 'Invalid billing email address') {
                            let input = $('#billing_email');
                            setErrorCheckoutField(input, 'Invalid email address');
                            $(node.remove());
                        }
                    }
                })
            }
        })
        initPortalClick();
    })

    let checkoutContent = $('.checkout__content').get(0);
    if(checkoutContent) {
        observer.observe(checkoutContent, {
            childList: true,
        });
    }

}

function initDisableErrorCheckout() {
    $('.checkout__input').on('input', function (event){
        $(this).removeClass('checkout__input_error');
    })
}


function isEmailValid(value) {
    return EMAIL_REGEXP.test(value);
}

function initSubscribeForm() {
    let subscribeForm = $('.subscribe__form');
    let subscribeButton = subscribeForm.find('.subscribe__submit');
    let statusText = subscribeForm.find('.subscribe__status-text');

    subscribeForm.find('.subscribe__input').on('input', function(event) {
        let value = $(this).val();
        if(value) {
            subscribeForm.addClass('subscribe__form_valid');
            subscribeForm.removeClass('subscribe__form_invalid');
            subscribeForm.removeClass('subscribe__form_success');
        }
        else {
            subscribeForm.removeClass('subscribe__form_invalid');
            subscribeForm.removeClass('subscribe__form_valid');
        }


        
        // if(isEmailValid(value)) {
        //     subscribeForm.addClass('subscribe__form_valid');
        //     subscribeForm.removeClass('subscribe__form_invalid');
        // }
        // else {
        //     subscribeForm.addClass('subscribe__form_invalid');
        //     subscribeForm.removeClass('subscribe__form_valid');
        // }

        // if(!value) {
        //     subscribeForm.removeClass('subscribe__form_invalid');
        //     subscribeForm.removeClass('subscribe__form_valid');
        // }

    })
    
    subscribeForm.on('submit', function (event) {
        event.preventDefault();

        let value = $(this).find('input').val();
        if(isEmailValid(value)) {
            subscribeButton.addClass('btn_loading');
            $.ajax({
                url: wp.url,
                method: 'POST',
                data: {
                    action: 'subscribe',
                    email: $(this).find('[name="email"]').val(),
                },
                success: (data) => {
                    subscribeButton.removeClass('btn_loading');
                    $(this).addClass('subscribe__form_success');
                    statusText.text('Subscribed! Stay tuned for the latest.');
                },
                error: (data) => {
                    console.log(data);
                },
            });


            // subscribeForm.addClass('subscribe__form_valid');
            // subscribeForm.removeClass('subscribe__form_invalid');
        }
        else {
            statusText.text('Wrong Email format');
            subscribeForm.addClass('subscribe__form_invalid');
            subscribeForm.removeClass('subscribe__form_valid');
        }
        
    })
}

function setErrorField(input, errorText) {
    let parent = $(input).parents('.input__label');
    parent.addClass('input__label_error');
    
    let errorTextNode = parent.find('.input__error-text');
    $(errorTextNode).text(errorText);
}

function initSendFeedbackForms() {
    $('.ajax-form').on('submit', function (event) {
        event.preventDefault(); 
        let isValid = true;
        let inputs = $(this).find('.input_required');

        $(inputs).each((index, input) => {
            
            if($(input).val() === '') {
                if($(input).parent().hasClass('select-extra-input')) {
                    let preferredMessengerInput = $(this).find('.input[name="preferred_messenger"]');
                    if($(preferredMessengerInput).val() == 'Other') {
                        setErrorField(input, 'Required field');
                        isValid = false;
                    }
                }
                else {
                    setErrorField(input, 'Required field');
                    isValid = false;
                }
            }

            if($(input).attr('type') == 'radio') {
                let radios = $(this).find('input[name="' + $(input).attr('name') + '"]');
                let onceChecked = false;
                $(radios).each((index, radio) => {
                    if($(radio).is(':checked')) {
                        onceChecked = true;
                    }
                })

                if(!onceChecked) {
                    setErrorField(input, 'Required field');
                    isValid = false;
                }
            }
        })



        let emailInput = $(this).find('.input[name="email"]');
        if(emailInput.length && !isEmailValid(emailInput.val())) {
            setErrorField(emailInput, 'Invalid Email');
            isValid = false;
        }

        let phoneInput = $(this).find('.input[name="phone"]');
        if(phoneInput.length && !phoneInput.get(0).iti.isValidNumber()) {
            setErrorField(phoneInput, 'Invalid Phone');
            isValid = false;
        }

        if(!isValid) {
            return false;
        }


        let submitButton = $(this).find('.btn_with-load');
        submitButton.addClass('btn_loading');

        let successModalID = $(this).data('success-modal') ? $(this).data('success-modal') : 'success-modal-dark';

        $.ajax({
            url: wp.url,
            method: 'POST',
            data: {
                action: 'submit',
                data: $(this).serialize(),
            },
            success: (data) => {
                submitButton.removeClass('btn_loading');
                UIkit.modal($('#' + successModalID)).show();
            },
            error: (data) => {
                console.log(data);
            },
        });
    })

    $('.ajax-form').find('input').on('input', function (event) {
        $(this).parents('.input__label').removeClass('input__label_error');
    })

    $('.ajax-form').find('select').on('change', function (event) {
        $(this).parents('.input__label').removeClass('input__label_error');
    })
}

function initFeedbackModalObserver(selector) {
    UIkit.util.on(selector, 'show', function (event) {
        let btn = $(this).find('.switcher__btn').get(0);
        if(btn) {
            $(this).find('.switcher__btn').get(0).click();
        }
    });
}

function initCustomModalLinks() {
    modals.forEach((modalName) => {
        $(`[href="#${modalName}"]`).each((index, link) => {
            if($(link).attr('uk-toggle') !== '') {
                $(link).on('click', function (event) {
                    event.preventDefault();
                    UIkit.modal($(`#${modalName}`)).show();
                })
            }
        })
        initFeedbackModalObserver('#' + modalName);
    })
}

function initBurgerButton() {
    let button = $('.header__burger');
    UIkit.util.on('#burger-menu', 'show', function (event) {
        button.addClass('header__burger_active');
    });

    UIkit.util.on('#burger-menu', 'hide', function (event) {
        button.removeClass('header__burger_active');
    });
}

function disableHeaderMenuItemsWithChildren() {
    $('.header__menu .menu-item-has-children > a').click((event) => {
        event.preventDefault();
    })
}

function init3dTiles() {
    const minRotateX = -30;
    const maxRotateX = 20;
    const minRotateY = -20;
    const maxRotateY = 20;

    $('.rotate3d').each(function(){
        
        $(this).on('mousemove', (event) => {
            // if(!$(event.target).hasClass('rotate3d')) {
            //     return;
            // }
            
            let x = event.offsetX - $(this).innerWidth() / 2;
            let y = event.offsetY - $(this).innerHeight() / 2;

            
            // if((Math.abs(x) > $(this).innerWidth() / 2 - 20) || (Math.abs(y) > $(this).innerHeight() / 2 - 20)) {
            //     $(this).css({
            //         transition: '.3s'
            //     })
            //     console.log('.3', Math.abs(y), $(this).innerHeight() / 2 - 20)
            // }
            // else {
            //     $(this).css({
            //         transition: '0s'
            //     })
            //     console.log('0', Math.abs(y), $(this).innerHeight() / 2 - 20)
            // }

            // if(Math.abs(y) > $(this).innerHeight() / 2 - 20) {
            //     $(this).css({
            //         transition: '.3s'
            //     })
            //     console.log('.3', Math.abs(y), $(this).innerHeight() / 2 - 20)
            // }
            // else {
            //     $(this).css({
            //         transition: '0s'
            //     })
            //     console.log('0', Math.abs(y), $(this).innerHeight() / 2 - 20)
            // }
            
            let rotateX = -y / 15;
            let rotateY = x / 30;
            let brightness = (-event.offsetY / $(this).innerHeight()) / 2 + 1;

            $(this).css({
                transform: `rotateX(${rotateX}deg) rotateY(${rotateY}deg)`,
                filter: `brightness(${brightness})`
            })

            // setTimeout(() => {
                
            // }, 300)
        })

        $(this).on('mouseover', (event) => {
            setTimeout(() => {
                $(this).css({
                    transition: '.0s'
                })
            }, 300)
            $(this).css({
                transform: `rotateX(0deg) rotateY(0deg)`,
                filter: `brightness(1)`,
                transition: '.3s'
            })
        })

        $(this).on('mouseout', (event) => {
            $(this).css({
                transform: `rotateX(0deg) rotateY(0deg)`,
                filter: `brightness(1)`,
                transition: '.3s'
            })
        })
    })
}

function initKoreanModal() {
    console.log('geo');
    if(localStorage.getItem('koreanModal2')) {
        return;
    }
    localStorage.setItem('koreanModal2', false);

    let params = (new URL(document.location)).searchParams;
    let modal = UIkit.modal($('#korean'));

    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function (position) {
            console.log(position);
            let x = position.coords.latitude;
            let y = position.coords.longitude;
            if(x > 33 && x < 43 && y > 124 && y < 132) {
                modal.show();
                localStorage.setItem('koreanModal2', true);
            }
        }, function(error) {
            if(wp.country == 'Республика Корея') {
                modal.show();
                localStorage.setItem('koreanModal2', true);
                console.log('geo ip');
            }
        });
    } else {
        if(wp.country == 'Республика Корея') {
            modal.show();
            localStorage.setItem('koreanModal2', true);
            console.log('geo ip');
        }
    }

    $('.korean-modal__close-btn').on('click', (event) => {
        modal.hide();
    })
}

function initSmoothScroll() {
    $('a[href*="#"]').click(function(e) {
        let id = $(this).attr('href');
        
        if(modals.includes(id.slice(1))) {
            return;
        }

        if (id && id !== '#') {
            let $id = $(id);

            if ($id.length) {
                e.preventDefault();
                $('html, body').animate({ scrollTop: $id.offset().top }, 'slow');
            }
        }
    });
}

function initCustomSelect() {
    $('.select').each((index, root) => {
        let inputNode = $(root).find('.select__input');
        let valueNode = $(root).find('.select__value');
        $(inputNode).on('change', (event) => {
            let value = $(inputNode).val();
            $(valueNode).text(value);
            if(value == "Other") {
                $(root).parent().next().removeClass('select-extra-input_hidden');
            }
            else {
                $(root).parent().next().addClass('select-extra-input_hidden');
            }
        })

        $(document).on('click', (event) => {
            if($(event.target).hasClass('select__input')) {
                $(inputNode).toggleClass('select__input_focus');
            }
            else {
                $(inputNode).removeClass('select__input_focus');
            }
        })
    })
}

function updateRadio() {
    $('.radio').each(function(index, radio) {
        let inputNode = $(radio).find('.radio__input');
        if($(inputNode).is(':checked')) {
            $(radio).addClass('radio_checked');
        }
        else {
            $(radio).removeClass('radio_checked');
        }
    })
}

function initCustomRadio() {
    $('.radio').each((index, radio) => {
        let inputNode = $(radio).find('.radio__input');
        $(inputNode).on('change', function(event) {
            updateRadio();
        })
    })
    
}

function initCustomModalClose() {
    $('.success-btn').on('click', function(event) {
        let modalID = $(this).parents('.uk-modal-dialog').parent().attr('id');

        let modal = UIkit.modal($('#' + modalID));
        modal.hide();
    })
}

function initPortalClick() {
    $(document).on('click', (event) => {
        let target = $(event.target).data('portal-click');
        let parents = $(event.target).parents('[data-portal-click]');
        if(!target && parents.length) {
            target = parents.data('portal-click');
        }
        if(!target) {
            return;
        }
        
        $(target).get(0).click();
    })
}

function initSoundButton() {
    $('.fullscreen-video__btn').click( function (event){
        
        let icon = $(this).find('.fullscreen-video__icon');
        let newIconSrc = icon.data('icon');
        let oldIconSrc = icon.attr('src');
        
        icon.attr('src', newIconSrc);
        icon.data('icon', oldIconSrc);

        let video = $('.fullscreen-video__video');
        video.get(0).muted = !video.get(0).muted;
        
    })
}

function initFullscreenSliderLikeStoriesSwitch() {
    $('.fullscreen-slider').click(function(event) {
        if(event.clientX < $(this).innerWidth() / 2) {
            swipers.fullscreen.slidePrev();
        }
        else {
            swipers.fullscreen.slideNext();
        }
    })
}

function initUTM() {
    console.log(params);
    let utms = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_content', 'utm_term', 'yclid'];

    utms.forEach((utm) => {
        if(params.has(utm)) {
            localStorage.setItem(utm, params.get(utm));
        }
    })

    $('.ajax-form').each((index, form) => {
        utms.forEach((utm) => {
            if(localStorage.getItem(utm)) {
                $(form).append(`<input type="hidden" name="${utm}" value="${localStorage.getItem(utm)}">`)
            }
        })

        $(form).append(`<input type="hidden" name="link" value="${url}">`)
    })
}

function initStoreFilters() {
    let filters = $('.store__dropdown-filters');
    let buttonLeft =  filters.find('.store__dropdown-filter-btn b');
    let buttonRight = filters.find('.store__dropdown-filter-btn-right-text');

    $('.store__dropdown-filter-elem').on('click', function(event) {
        let val = $(this).find('.radio__input').val();
        let size = $(this).find('.store__dropdown-filter-elem-right').data('btn-text');
        
        if(val === 'All') {
            filters.addClass('store__dropdown-filters_all');
        }
        else {
            filters.removeClass('store__dropdown-filters_all');
        }
        buttonLeft.text(val);
        buttonRight.text(size);
        filters.removeClass('store__dropdown-filters_active');
        $(this).find('.radio__input').prop("checked", true);
        updateRadio();
    })

    $('.store__dropdown-filter-btn').on('click', function(event) {
        if($(event.target).hasClass('store__dropdown-filter-btn-link') || $(event.target).parents('.store__dropdown-filter-btn-link').length) {
            filters.addClass('store__dropdown-filters_all');
            buttonLeft.text('All');
            return;
        }
        filters.addClass('store__dropdown-filters_active');
    })

    $(document).on('click', function(event) {
        if(!$(event.target).hasClass('store__dropdown-filters') && !$(event.target).parents('.store__dropdown-filters').length) {
            filters.removeClass('store__dropdown-filters_active');
        }
    })
}

function initMobileStoreFilters() {
    let modal = $('#store-mobile-filter');
    let filters = $('.store__dropdown-filters');
    let buttonLeft =  filters.find('.store__dropdown-filter-btn b');
    let buttonRight = filters.find('.store__dropdown-filter-btn-right-text');

    $('.store__dropdown-filters').on('click', function(event) {
        if($(event.target).hasClass('store__dropdown-filter-btn-link') || $(event.target).parents('.store__dropdown-filter-btn-link').length) {
            filters.addClass('store__dropdown-filters_all');
            buttonLeft.text('All');
            return;
        }
        UIkit.modal(modal).show();
    })

    $('.store__mobile-filter__button').on('click', function(event) {
        modal.find('.radio__input').each((index, input) => {
            if($(input).prop("checked")) {
                let val = $(input).val();
                let size = $(input).parents('.store__dropdown-filter-elem').find('.store__dropdown-filter-elem-right').data('btn-text');
                
                
                if(val === 'All') {
                    filters.addClass('store__dropdown-filters_all');
                    filters.find('[uk-filter-control=""]').get(0).click();
                }
                else {
                    filters.removeClass('store__dropdown-filters_all');
                    filters.find(`[uk-filter-control="filter: [data-size='${val}'];"]`).get(0).click();
                }
                buttonLeft.text(val);
                buttonRight.text(size);
                
            }
        })
        UIkit.modal(modal).hide();

        
    })
}

function initCustomSticky() {
    let lastScroll = 0;
    $(document).on("scroll", function() {
        let currentScroll = $(this).scrollTop();
        let headerHeight = $('.header').height();
        
        if($('.sticky-product').hasClass('sticky-product_active')) {
            if(lastScroll > currentScroll) {
                $('.sticky-product').addClass('sticky-product_offset');
            }
            else {
                $('.sticky-product').removeClass('sticky-product_offset');
            }

            if ($('.header__sticky-wrapper').css('position') === 'relative') {
                const currentOffsetTop = headerHeight - currentScroll;
                $('.sticky-product').css('--sticky-product-offset-top', currentOffsetTop <= 0 ? 0 : currentOffsetTop + 'px');
            } else {
                $('.sticky-product').css('--sticky-product-offset-top', '');
            }
        }

        lastScroll = currentScroll;
    });

    // 1. Создаем Observer
    const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if (entry.isIntersecting) {
            console.log("Кнопка видна!", entry.target);
            $('.sticky-product').removeClass('sticky-product_active');
            $('.sticky-product').removeClass('sticky-product_offset');
        } else {
            console.log("Кнопка скрыта.", entry.target);
            $('.sticky-product').addClass('sticky-product_active');
            if(isMobile) {
                $('.sticky-product').addClass('sticky-product_offset');
            }
        }
    });
    }, {
        threshold: 0.1
    });

    // 2. Находим кнопку (или другой элемент)
    const button = $('.product-detail__info .product-detail__btn, .cart__total-btn, .checkout__side-wrapper');

    // 3. Начинаем наблюдение за элементом
    if (button.length) {
        console.log(button.get(0));
        observer.observe(button.get(0));
    }
    
}

function initCartWidgetCancel() {
    $('.cart-widget__cancel').on('click', (event) => {
        UIkit.modal($('#cart-widget')).hide();
    })
}

document.addEventListener('DOMContentLoaded', (event) => {
    initSwipers();
    if(!isTablet) {
        initCatalogItemSwipe();
    }
    initCatalogItemColorSwitcher();
    if(isTablet) {
        initFooterAccordeon();
        initInstagramParallax();
        initCatalogItemDotsToggle();
    }
    initAutoplayButton();
    initSwitchers();
    initAccordeons();
    initAvatarSwitcher();
    initAddToCart();
    initRemoveFromCart();
    initSelectCartItemCount();
    initCouponAjax();
    initVerifyMask();
    initVerifyDetailForm();
    initVerifyForm();
    initFilterStore();
	setTimeout(() => {
		updateLockNav();
	}, 100)
    initPhoneMask();
    initCheckoutValidation();
    initDisableErrorCheckout();
    initInputPlaceholders();
    initSubscribeForm();
    initSendFeedbackForms();
    initCustomModalLinks();
    initBurgerButton();
    disableHeaderMenuItemsWithChildren();
    if(!isTablet) {
        init3dTiles();
    }
    initKoreanModal();
    initSmoothScroll();
    initCustomSelect();
    initCustomRadio();
    initCustomModalClose();
    initPortalClick();
    initSoundButton();
    initFullscreenSliderLikeStoriesSwitch();
    initUTM();
    if(!isMobile) {
        initStoreFilters();
    }
    if(isMobile) {
        initMobileStoreFilters();
    }
    initCustomSticky();
    initCartWidgetCancel();
})

const buttons = document.querySelectorAll('.switcher__btn');
let maxWidth = 0;

buttons.forEach(btn => {
    const width = btn.scrollWidth;
    if (width > maxWidth) maxWidth = width;
});

buttons.forEach(btn => {
    btn.style.minWidth = `${maxWidth}px`;
});
