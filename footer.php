<?
$showFooter = true;

// Verify NFC Page
if(get_the_ID() == 1200 && !is_404()) {
    $showFooter = false;
}

// Store
$footerClass = '';
if(get_the_ID() == 872) {
    $footerClass = 'footer_last-white';
}

if(is_cart()) {
    $footerClass = 'footer_last-white';
}
if(is_checkout()) {
    $footerClass = 'footer_last-white';
}
?>

</main>

<?php get_template_part("templates/cookies", "banner"); ?>
<?php get_template_part("templates/cookies", "modal"); ?>

<? if($showFooter): ?>
    <footer class="footer <?=$footerClass?>">
        <div class="container footer__container">
            <div class="footer__separator"></div>
            <div class="footer__content">
                <div class="text_h2 footer__title-wrapper">
                    <span class="footer__title footer__title_full-width">Dream. Create.</span>
                    <img src="<?=get_template_directory_uri()?>/assets/images/fail.png" class="footer__title-img">
                    <span class="footer__title">Believe.</span>
                </div>
                <div class="footer__menus">
                    <div class="footer__menu-wrapper">
                        <span class="footer__menu-title">
                            <span class="text_link">Main</span>
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" class="show-tablet footer__menu-plus" uk-svg>
                        </span>
                        <?
                            wp_nav_menu( array(
                                'menu'              => 'footer-main', // ID, имя или ярлык меню
                                'menu_class'        => 'footer__menu', // класс элемента <ul>
                                'menu_id'           => '', // id элемента <ul>
                                'container'         => false, // тег контейнера или false, если контейнер не нужен
                                'container_class'   => '', // класс контейнера
                                'container_id'      => '', // id контейнера
                                'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                                'before'            => '', // текст (или HTML) перед <a
                                'after'             => '', // текст после </a>
                                'link_before'       => '', // текст перед текстом ссылки
                                'link_after'        => '', // текст после текста ссылки
                                'echo'              => true, // вывести или вернуть
                                'depth'             => 0, // количество уровней вложенности
                                'walker'            => '', // объект Walker
                                'theme_location'    => '', // область меню
                                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'item_spacing'      => 'preserve',
                            ) );
                        ?>
                        <!-- <ul class="">
                            <li class="text_link underline underline_invert">
                                <a href="#">Home</a>
                            </li>
                            <li class="text_link underline underline_invert">
                                <a href="#">Store</a>
                            </li>
                            <li class="text_link underline underline_invert"><a href="#">Collections</a>
                            </li>
                            <li class="text_link underline underline_invert">
                                <a href="#">members Login</a>
                            </li>
                        </ul> -->
                    </div>
                    <div class="footer__menu-wrapper">
                        <span class="footer__menu-title">
                            <span class="text_link">About</span>
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" class="show-tablet footer__menu-plus" uk-svg>
                        </span>
                        <?
                            wp_nav_menu( array(
                                'menu'              => 'footer-about', // ID, имя или ярлык меню
                                'menu_class'        => 'footer__menu', // класс элемента <ul>
                                'menu_id'           => '', // id элемента <ul>
                                'container'         => false, // тег контейнера или false, если контейнер не нужен
                                'container_class'   => '', // класс контейнера
                                'container_id'      => '', // id контейнера
                                'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                                'before'            => '', // текст (или HTML) перед <a
                                'after'             => '', // текст после </a>
                                'link_before'       => '', // текст перед текстом ссылки
                                'link_after'        => '', // текст после текста ссылки
                                'echo'              => true, // вывести или вернуть
                                'depth'             => 0, // количество уровней вложенности
                                'walker'            => '', // объект Walker
                                'theme_location'    => '', // область меню
                                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'item_spacing'      => 'preserve',
                            ) );
                        ?>
                        <!-- <ul class="footer__menu">
                            <li class="text_link underline underline_invert"><a href="#">Who is TUD?</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Verification</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Company</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Members Club</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Delivery</a></li>
                            <li class="text_link underline underline_invert"><a href="#">News & Events</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Press Kits</a></li>
                        </ul> -->
                    </div>
                    <div class="footer__menu-wrapper">
                        <span class="footer__menu-title">
                            <span class="text_link">Contact</span>
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" class="show-tablet footer__menu-plus" uk-svg>
                        </span>
                        <?
                            wp_nav_menu( array(
                                'menu'              => 'footer-contact', // ID, имя или ярлык меню
                                'menu_class'        => 'footer__menu', // класс элемента <ul>
                                'menu_id'           => '', // id элемента <ul>
                                'container'         => false, // тег контейнера или false, если контейнер не нужен
                                'container_class'   => '', // класс контейнера
                                'container_id'      => '', // id контейнера
                                'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                                'before'            => '', // текст (или HTML) перед <a
                                'after'             => '', // текст после </a>
                                'link_before'       => '', // текст перед текстом ссылки
                                'link_after'        => '', // текст после текста ссылки
                                'echo'              => true, // вывести или вернуть
                                'depth'             => 0, // количество уровней вложенности
                                'walker'            => '', // объект Walker
                                'theme_location'    => '', // область меню
                                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'item_spacing'      => 'preserve',
                            ) );
                        ?>
                        <!-- <ul class="footer__menu">
                            <li class="text_link underline underline_invert"><a href="#">Art Manager</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Store Point</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Partnership</a></li>
                            <li class="text_link underline underline_invert"><a href="#">Support</a></li>
                            <li class="text_link underline underline_invert"><a href="#">all Contacts</a></li>
                        </ul> -->
                    </div>
                    <div class="footer__menu-wrapper">
                        <span class="footer__menu-title">
                            <span class="text_link">Social</span>
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" class="show-tablet footer__menu-plus" uk-svg>
                        </span>
                        <?
                            wp_nav_menu( array(
                                'menu'              => 'footer-social', // ID, имя или ярлык меню
                                'menu_class'        => 'footer__menu', // класс элемента <ul>
                                'menu_id'           => '', // id элемента <ul>
                                'container'         => false, // тег контейнера или false, если контейнер не нужен
                                'container_class'   => '', // класс контейнера
                                'container_id'      => '', // id контейнера
                                'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                                'before'            => '', // текст (или HTML) перед <a
                                'after'             => '', // текст после </a>
                                'link_before'       => '', // текст перед текстом ссылки
                                'link_after'        => '', // текст после текста ссылки
                                'echo'              => true, // вывести или вернуть
                                'depth'             => 0, // количество уровней вложенности
                                'walker'            => '', // объект Walker
                                'theme_location'    => '', // область меню
                                'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'item_spacing'      => 'preserve',
                            ) );
                        ?>
                    </div>
                </div>
                <div class="footer__form-wrapper">
                    <span class="text_body footer__form-title">Get Exclusive Insights</span>
                    <span class="text_body-small footer__form-text">Sign up and stay up to date on product launches and pre order.</span>
                    <form action="#" class="footer__form subscribe__form">
                        <div class="subscribe__input-wrapper">
                            <input class="text_body-small input subscribe__input" type="text" name="email" placeholder="Email">
                            <button class="btn subscribe__submit btn_with-load">
                                <img class="subscribe__submit-icon subscribe__submit-icon_check" src="<?=get_template_directory_uri()?>/assets/images/icons/check.svg" uk-svg>
                                <img class="subscribe__submit-icon subscribe__submit-icon_error" src="<?=get_template_directory_uri()?>/assets/images/icons/cross.svg" uk-svg>
                                <div class="btn__loader-wrapper">
                                    <span class="loader"></span>
                                </div>
                            </button>
                        </div>
                        <span class="subscribe__status-text text_caption-small">Wrong Email format</span>
                    </form>
                    
                </div>
            </div>
            <div class="footer__bottom">
                <div class="footer__bottom-left">
                    <span class="text_caption footer__rights-text">2025, All Rights Reserved</span>
                    <?
                        wp_nav_menu( array(
                            'menu'              => 'footer-privacy', // ID, имя или ярлык меню
                            'menu_class'        => 'footer__privacy-menu', // класс элемента <ul>
                            'menu_id'           => '', // id элемента <ul>
                            'container'         => false, // тег контейнера или false, если контейнер не нужен
                            'container_class'   => '', // класс контейнера
                            'container_id'      => '', // id контейнера
                            'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                            'before'            => '', // текст (или HTML) перед <a
                            'after'             => '', // текст после </a>
                            'link_before'       => '', // текст перед текстом ссылки
                            'link_after'        => '', // текст после текста ссылки
                            'echo'              => true, // вывести или вернуть
                            'depth'             => 0, // количество уровней вложенности
                            'walker'            => '', // объект Walker
                            'theme_location'    => '', // область меню
                            'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'item_spacing'      => 'preserve',
                        ) );
                    ?>
                    <!-- <ul class="footer__privacy-menu">
                        <li class="text_caption"><a href="#">Privacy policy</a></li>
                        <li class="text_caption"><a href="#">License agreement</a></li>
                        <li class="text_caption"><a href="#">Documents</a></li>
                        <li class="text_caption"><a href="#">Terms & Conditions</a></li>
                    </ul> -->
                </div>
                <div class="footer__pays">
                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/pay/visa.svg" class="footer__pay-img" alt="">
                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/pay/master-card.svg" class="footer__pay-img" alt="">
                    <!-- <img src="<?=get_template_directory_uri()?>/assets/images/icons/pay/apple-pay.svg" class="footer__pay-img" alt="">
                    <img src="<?=get_template_directory_uri()?>/assets/images/icons/pay/google-pay.svg" class="footer__pay-img" alt=""> -->
                </div>
            </div>
        </div>
        <div class="footer__bottom-fix"></div>
    </footer>

<? endif; ?>

<? 
    // Is Collector's sets page check
    $is_collectors_set = get_field('is_collectors_sets');

    $whatsapp_link = 'https://bit.ly/43GOwbM';
    $telegram_link = 'https://t.me/m/A1m_zbKbZGRk';

    if ($is_collectors_set) {
        $whatsapp_link = 'https://bit.ly/43ty2mc';
        $telegram_link = 'https://t.me/m/5YlUban9YmY8';
    }
?>

<div id="art-manager" class="art-manager" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical art-manager__modal">

        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <h2 class="art-manager__title text_h2">Connect with Your<br>Art Manager</h2>
        <div class="art-manager__buttons">
            <a href="<? echo $whatsapp_link ?>" target="_blank" class="btn art-manager__btn btn_whatsapp text_btn">Chat on WhatsApp</ф>
            <a href="<? echo $telegram_link ?>" target="_blank" class="btn art-manager__btn btn_telegram text_btn">Chat on Telegram</a>
            <a href="#feedback" uk-toggle class="btn art-manager__btn btn_email text_btn">Need a Call or Email?</a>
        </div>
    </div>
</div>

<div id="key-popup" class="key-popup" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical key-popup__modal">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <div class="key-popup-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" viewBox="0 0 48 48" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M31.2628 3.11263C31.8865 3.54785 32.5088 3.98212 33.1434 4.38373C34.1338 5.00326 35.1668 5.45065 36.2255 5.7174C36.7941 5.8628 37.3683 5.98218 37.9425 6.10156C38.4673 6.21067 38.992 6.31978 39.5125 6.44876C40.2126 6.62084 41.0407 6.82734 41.8518 7.11987C44.4985 8.05777 46.3853 9.9421 47.461 12.7213C47.6915 13.315 47.8452 14.0463 47.9391 14.9326C48.1952 17.5483 47.6403 20.207 46.334 22.6334C44.3277 26.3418 41.7408 31.0828 40.7675 32.666C39.7857 34.2836 36.5585 39.644 35.8413 40.8658C35.2693 41.8295 34.5777 42.7502 33.724 43.6794C32.1104 45.4347 30.2748 46.6479 28.2002 47.3363C26.8996 47.7679 25.4995 47.9848 24 48C22.5005 47.9848 21.1004 47.7679 19.7998 47.3363C17.7252 46.6479 15.8896 45.4347 14.276 43.6794C13.4222 42.7502 12.7307 41.8295 12.1587 40.8658C11.4415 39.644 8.21431 34.2836 7.23249 32.666C6.25921 31.0828 3.67229 26.3418 1.66595 22.6334C0.359715 20.207 -0.195229 17.5483 0.0608993 14.9326C0.154821 14.0463 0.308481 13.315 0.539013 12.7213C1.61472 9.9421 3.50154 8.05777 6.14819 7.11987C6.95927 6.82734 7.78743 6.62084 8.48749 6.44876C9.00807 6.31975 9.53294 6.21062 10.0578 6.10149C10.6319 5.98213 11.206 5.86277 11.7745 5.7174C12.8332 5.45065 13.8662 5.00326 14.8566 4.38373C15.4912 3.98212 16.1135 3.54785 16.7372 3.11263C17.8897 2.30834 19.0469 1.50085 20.295 0.89039C22.7081 -0.296797 25.2919 -0.296796 27.705 0.89039C28.9531 1.50084 30.1103 2.30835 31.2628 3.11263ZM26.4247 26.0147C29.2239 25.0255 31.2294 22.3559 31.2294 19.218C31.2294 15.2378 28.0029 12.0113 24.0227 12.0113C20.0425 12.0113 16.816 15.2378 16.816 19.218C16.816 22.3558 18.8213 25.0252 21.6202 26.0146V33.6313C21.6202 34.9581 22.6957 36.0336 24.0225 36.0336C25.3492 36.0336 26.4247 34.9581 26.4247 33.6313V26.0147Z" fill="#01B45B"/>
            </svg>
        </div>
        <h2 class="key-popup__title text_h2">Unlocked for You</h2>
        <span class="text_body key-popup__description">A Collector’s Key has just been revealed. Enjoy <b>5% off</b> — a quiet reward for true collectors.</span>
        <div class="promo-key">
            <span class="promo-box text_h3" id="promoCode">TUDWLCM</span>
        </div>
        <div class="key-popup__buttons">
            <a class="btn key-popup__cart-button text_btn">Apply in Cart</a>
        </div>
    </div>
</div>

<div id="feedback" class="art-manager" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical art-manager__modal">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <a href="#art-manager" uk-toggle class="modal-back" type="button">
            <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
        </a>
        <h1 class="text_h2 feedback__title">Let Us Get Back to You</h1>
        <span class="text_body feedback__text">Your request is our priority. We'll respond within 24 hours by your chosen method.</span>
        <div class="feedback__content">
            <form action="#" class="feedback__form ajax-form" data-success-modal="success-modal-dark">
                <label class="feedback__input input__label">
                    <input type="text" name="name" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Name</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label input-mask input-mask_disabled">
                    <input type="text" name="phone" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder input__placeholder_focus">Phone</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="input__label feedback__input">
                    <div class="select">
                        <select class="select__input input input_required" name="preferred_messenger">
                            <option value hidden selected></option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Telegram">Telegram</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="select__placeholder text_body-small input__placeholder">Preferred Messenger</span>
                        <span class="select__value text_body-small"></span>
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/dropdown.svg" class="select__arrow" uk-svg>
                    </div>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label select-extra-input select-extra-input_hidden">
                    <input type="text" name="messanger" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Messenger or Contact Link</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label">
                    <input type="text" name="email" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Email</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label feedback__input_textarea">
                    <textarea type="text" name="message" class="text_body-small input input_checkout"></textarea>
                    <span class="text_body-small input__placeholder">Any details or requests</span>
                </label>
                <button class="btn btn_white feedback__btn btn_with-load">
                    <span class="text_btn btn__text">Submit</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </form>
        </div>
        <span class="text_caption feedback__privacy-text">By submitting you accept our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
    </div>
</div>

<div id="support" class="support-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical art-manager__modal">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <h1 class="text_h2 feedback__title">Need Assistance?</h1>
        <span class="text_body feedback__text">Our team is here to help.<br>We’ll respond within 24 hours.</span>
        <!-- <div class="feedback__switcher switcher switcher_white">
            <button class="text_body-small btn switcher__btn" data-switch-button="0" data-switch-button-single>Call Me</button>
            <button class="text_body-small btn switcher__btn" data-switch-button="1" data-switch-button-single>Email Me</button>
            <div class="switcher__back"></div>
        </div> -->
        <div class="feedback__content">
            <form action="#" class="feedback__form ajax-form" data-success-modal="success-modal-light">
                <label class="feedback__input input__label">
                    <input type="text" name="name" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Name</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label input-mask input-mask_white input-mask_disabled">
                    <input type="text" name="phone" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder input__placeholder_focus">Phone</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>

                <label class="input__label feedback__input">
                    <div class="select">
                        <select class="select__input input input_required" name="preferred_messenger">
                            <option value hidden selected></option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Telegram">Telegram</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="select__placeholder text_body-small input__placeholder">Preferred Messenger</span>
                        <span class="select__value text_body-small"></span>
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/dropdown.svg" class="select__arrow" uk-svg>
                    </div>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label select-extra-input select-extra-input_hidden">
                    <input type="text" name="messanger" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Messenger or Contact Link</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label feedback__input_textarea">
                    <textarea type="text" name="message" class="text_body-small input input_checkout"></textarea>
                    <span class="text_body-small input__placeholder">Any details or requests</span>
                </label>
                <button class="btn feedback__btn btn_with-load">
                    <span class="text_btn btn__text">Submit</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </form>
            <!-- <form action="#" class="feedback__form ajax-form">
                <label class="feedback__input input__label">
                    <input type="text" name="name" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Name</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label">
                    <input type="text" name="email" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Email</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label feedback__input_textarea">
                    <textarea type="text" name="message" class="text_body-small input input_checkout"></textarea>
                    <span class="text_body-small input__placeholder">Message</span>
                </label>
                <button class="btn feedback__btn btn_with-load">
                    <span class="text_btn btn__text">Submit</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </form> -->
        </div>
        <span class="text_caption feedback__privacy-text">By submitting you accept our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
    </div>
</div>

<div id="members-club" class="art-manager members-club" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical art-manager__modal">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <img class="members-club__image" src="<?=get_template_directory_uri()?>/assets/images/members-modal.jpg">
        <h1 class="text_h2 feedback__title">Your Exclusive Invite Awaits</h1>
        <span class="text_h3 feedback__text members-subtitle">The TUD Members Club is coming in 2025. Enter your info & join the first wave.</span>
        <div class="feedback__content members__feedback-content">
            <form action="#" class="feedback__form ajax-form" data-success-modal="success-modal-members">
                <div class="feedback__input members-radio input__label">
                    <span class="members-radio__title text_body">Do you already own a TUD?</span>
                    <div class="members-radio__inputs">
                        <label class="radio">
                            <input type="radio" name="has_tud" value="Yes" class="text_body-small radio__input input_required">
                            <div class="radio__circle"></div>
                            <span class="text_body-small radio__placeholder text_body">Yes</span>
                        </label>
                        <label class="radio">
                            <input type="radio" name="has_tud" value="Not yet" class="text_body-small radio__input input_required">
                            <div class="radio__circle"></div>
                            <span class="text_body-small radio__placeholder text_body">Not yet</span>
                        </label>
                    </div>
                    <span class="input__error-text text_caption-small"></span>
                </div>
                <label class="feedback__input input__label">
                    <input type="text" name="name" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Name</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label input-mask input-mask_disabled">
                    <input type="text" name="phone" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder input__placeholder_focus">Phone</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="input__label feedback__input">
                    <div class="select">
                        <select class="select__input input input_required" name="preferred_messenger">
                            <option value hidden selected></option>
                            <option value="WhatsApp">WhatsApp</option>
                            <option value="Telegram">Telegram</option>
                            <option value="Other">Other</option>
                        </select>
                        <span class="select__placeholder text_body-small input__placeholder">Preferred Messenger</span>
                        <span class="select__value text_body-small"></span>
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/dropdown.svg" class="select__arrow" uk-svg>
                    </div>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label select-extra-input select-extra-input_hidden">
                    <input type="text" name="messanger" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Messenger or Contact Link</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <label class="feedback__input input__label">
                    <input type="text" name="email" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Email</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <button class="btn btn_white feedback__btn btn_with-load">
                    <span class="text_btn btn__text">Submit</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </form>
        </div>
        <span class="text_caption feedback__privacy-text">By submitting you accept our <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a></span>
    </div>
</div>

<div id="success-modal-dark" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical success-modal__wrapper">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <h2 class="success-modal__title text_h2 text_mobile_h1-medium">Got Your Message!</h2>
        <span class="success-modal__text text_body">We'll be in touch shortly to assist you further.</span>
        <button class="btn btn_white success-btn text_btn">OK</button>
    </div>
</div>

<div id="success-modal-light" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical success-modal__wrapper success-modal__wrapper_light">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <h2 class="success-modal__title text_h2 text_mobile_h1-medium">Got Your Message!</h2>
        <span class="success-modal__text text_body">We'll be in touch shortly to assist you further.</span>
        <button class="btn success-btn text_btn">OK</button>
    </div>
</div>

<div id="success-modal-members" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical success-modal__wrapper success-modal__wrapper_members">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <h2 class="success-modal__title text_h2 text_mobile_h1-medium">You’re almost in!</h2>
        <span class="success-modal__text text_body">Thanks for sharing your details — consider this your official pass to something extraordinary. We’ll be in touch soon with inspiration, privileges, and everything you didn’t know you needed. Stay tuned, the TUDs universe is just beginning.</span>
    </div>
</div>

<div id="burger-menu" class="uk-modal-full" uk-modal>
    <div class="uk-modal-dialog uk-modal-body burger-menu__wrapper">
        <div class="burger-menu__large-menu">
            <a href="/store/" class="burger-menu__large-link text_h1-medium">Store</a>
            <a href="/collections/" class="burger-menu__large-link text_h1-medium">Collections</a>
            <a href="/about-members-club/" class="burger-menu__large-link text_h1-medium">Members Club</a>
        </div>
        <div class="burger-menu__group">
            <span class="burger-menu__group-title text_h3">About</span>
            <?
                wp_nav_menu( array(
                    'menu'              => 'burger-about', // ID, имя или ярлык меню
                    'menu_class'        => 'burger-menu__group-menu', // класс элемента <ul>
                    'menu_id'           => '', // id элемента <ul>
                    'container'         => false, // тег контейнера или false, если контейнер не нужен
                    'container_class'   => '', // класс контейнера
                    'container_id'      => '', // id контейнера
                    'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                    'before'            => '', // текст (или HTML) перед <a
                    'after'             => '', // текст после </a>
                    'link_before'       => '', // текст перед текстом ссылки
                    'link_after'        => '', // текст после текста ссылки
                    'echo'              => true, // вывести или вернуть
                    'depth'             => 0, // количество уровней вложенности
                    'walker'            => '', // объект Walker
                    'theme_location'    => '', // область меню
                    'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'item_spacing'      => 'preserve',
                ) );
            ?>
        </div>
        <div class="burger-menu__group">
            <span class="burger-menu__group-title text_h3">Contact</span>
            <?
                wp_nav_menu( array(
                    'menu'              => 'burger-contact', // ID, имя или ярлык меню
                    'menu_class'        => 'burger-menu__group-menu', // класс элемента <ul>
                    'menu_id'           => '', // id элемента <ul>
                    'container'         => false, // тег контейнера или false, если контейнер не нужен
                    'container_class'   => '', // класс контейнера
                    'container_id'      => '', // id контейнера
                    'fallback_cb'       => 'wp_page_menu', // колбэк функция, если меню не существует
                    'before'            => '', // текст (или HTML) перед <a
                    'after'             => '', // текст после </a>
                    'link_before'       => '', // текст перед текстом ссылки
                    'link_after'        => '', // текст после текста ссылки
                    'echo'              => true, // вывести или вернуть
                    'depth'             => 0, // количество уровней вложенности
                    'walker'            => '', // объект Walker
                    'theme_location'    => '', // область меню
                    'items_wrap'        => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                    'item_spacing'      => 'preserve',
                ) );
            ?>
        </div>
    </div>
</div>

<div id="korean" class="korean-modal" uk-modal>
    <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical korean-modal__modal">
        <button class="uk-modal-close-default modal-close korean-modal__close" type="button" uk-close></button>
        <img class="korean-modal__image" src="<?=get_template_directory_uri()?>/assets/images/korean.svg">
        <h1 class="text_h2 korean-modal__title">Looks Like You’re<br>in Korea</h1>
        <span class="text_body korean-modal__text">For the best experience, visit our Korean website. Get local offers, language support, and seamless shopping.</span>
        <a href="https://tudtoy.co.kr" class="korean-modal__btn btn text_btn">tudtoy.co.kr</a>
        <button class="korean-modal__close-btn btn text_btn" uk-toggle>Stay Here</button>
    </div>
</div>

<? if(is_product()): ?>
    <?
        global $product;
        $tud = $product;

        $tud_id = $tud->get_id();
        $size_label = get_field('size_label', $tud_id); 
        if($size_label == 'S') {
            $size_image = 'size-s.svg';
        }
        elseif($size_label == 'M') {
            $size_image = 'size-m.svg';
        }
        elseif($size_label == 'L') {
            $size_image = 'size-l.svg';
        }    

        $isPurchasable = true;       
        if(!empty(get_field('text_instead_of_price', $tud_id))) {
            $isPurchasable = false;
        }

        $collection = get_field('collection', $tud_id);
        $collection_title = get_the_title($collection);
        $collection_title = "TUD x " . $collection_title;
    ?>
    <div class="sticky-product">
        <div class="sticky-product__container container">
            <div class="sticky-product__left">
                <div class="text_caption sticky-product__name"><?=$collection_title?></div>
                <div class="catalog-item__info sticky-product__info">
                    <span class="text_caption catalog-item__price">
                        <? if($isPurchasable): ?>
                            <?=$tud->get_price_html();?>
                        <? else: ?>
                            <?=get_field('text_instead_of_price', $tud_id);?>
                        <? endif; ?>
                    </span>
                    <div class="catalog-item__separator sticky-product__separator"></div>
                    <span class="catalog-item__size">
                        <span class="text_caption">Size</span>
                        <div class="catalog-item__size-icon sticky-product__size size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;" tabindex="0">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                        </div>
                    </span>
                </div>
            </div>
            <div class="sticky-product__right">
                <button class="btn text_btn sticky-product__btn product-detail__btn" data-ID="<?=get_the_ID()?>">
                    <span class="product-detail__btn-text">Add to Cart</span>
                    <div class="product-detail__btn-loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </div>
        </div>
    </div>
<? endif; ?>


<? if(is_cart()): ?>
    <div class="sticky-product sticky-product_checkout">
        <div class="sticky-product__container container">
            <div class="sticky-product__left">
                <div class="sticky-product__text text_caption">Subtotal</div>
                <div class="sticky-product__price text_body"><?=wc_cart_totals_order_total_html();?></div>
            </div>
            <div class="sticky-product__right">
                <a href="/checkout/" class="btn text_btn sticky-product__btn">Checkout</a>
            </div>
        </div>
    </div>
<? endif; ?>

<? if(is_checkout()): ?>
    <div class="sticky-product sticky-product_checkout">
        <div class="sticky-product__container container">
            <div class="sticky-product__left">
                <div class="sticky-product__text text_caption">Your Order</div>
                <div class="sticky-product__price text_body"><?=wc_cart_totals_order_total_html();?></div>
            </div>
            <div class="sticky-product__right">
                <a href="#total-cart-modal" class="btn text_btn sticky-product__btn" uk-toggle>View</a>
            </div>
        </div>
    </div>

    <div class="total-cart-modal" id="total-cart-modal" uk-modal>
        <div class="uk-modal-dialog uk-modal-body">
            <div class="text_h3 cart-widget__title">Your Order</div>
            <button class="uk-modal-close total-cart__close" type="button" uk-close></button>

            <div class="checkout__total checkout__total_modal">
                <div class="checkout__total-products">
                    <? foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
                        <?
                            $tud_id = $cart_item['product_id'];
                            $tud = wc_get_product($tud_id);
                            $collection = get_field('collection', $tud_id);
                            $is_collectors_sets = get_field('is_collectors_sets', $tud_id);

                            $size_label = get_field('size_label', $tud_id);

                            $price = $cart_item['line_total'];
                            if($price == 0) {
                                $price = 'FREE';
                            }
                            else {
                                $price = '$' . $price;
                            }
                        ?>

                        <div class="checkout__total-product-row">
                            <img src="<?=get_field('avatar', $tud_id)['sizes']['thumbnail'];?>" class="checkout__total-avatar">
                            <div class="checkout__total-product-info">
                                <div class="checkout__total-product-row-left">
                                    <? if(!empty(get_field('text_instead_of_price', $tud_id))): ?>
                                        <span class="text_body-small checkout__total-product-name"><?=$tud->get_name()?></span>
                                    <? else: ?>
                                        <span class="text_body-small checkout__total-product-name">TUD x <?=get_the_title($collection)?></span>
                                    <? endif; ?>
                                    
                                    <? if ( !$is_collectors_sets ) : ?>
                                        <span class="text_caption-small checkout__total-product-props">Size <?=get_field('size_label', $tud_id)?> / <?=get_field('dimensions_mm', $tud_id)['height']?> mm</span>
                                    <? else : ?>
                                        <? $i = 0; ?>

                                        <? if( have_rows('size', $tud_id) ): ?>
                                            <span class="text_caption-small checkout__total-product-props">
                                                <? while( have_rows('size', $tud_id) ) : the_row(); ?>
                                                    <? 
                                                        $size_label = get_sub_field('size_label');
                                                        $size_add_text = get_sub_field('size_add_text');
                                                    ?>
                                                    Size <?=$size_label?> / <?=get_sub_field('dimensions_mm')['height']?> mm
                                                    <? if ($i == 0) : ?>
                                                        + 
                                                    <? endif; ?>

                                                    <? $i++; ?>
                                                <? endwhile; ?>
                                            </span>
                                        <? endif; ?>
                                    <? endif; ?>
                                </div>
                                <div class="checkout__total-product-row-right">
                                    <span class="text_caption checkout__total-product-quantity">x<?=$cart_item['quantity']?></span>
                                    <span class="text_body-small checkout__total-product-price"><?=$price?></span>
                                </div>
                            </div>
                        </div>

                    <? endforeach; ?>
                </div>
                <div class="checkout__total-rows">
                    <div class="checkout__total-row">
                        <div class="checkout__total-row-left">
                            <div class="text_body-small checkout__total-row-title">Items</div>
                        </div>
                        <div class="checkout__total-row-right">
                            <span class="text_caption checkout__total-row-quantity">x<?=WC()->cart->cart_contents_count;?></span>
                            <span class="text_body-small checkout__total-row-price"><?=wc_cart_totals_subtotal_html();?></span>
                        </div>
                    </div>
                    <!-- <div class="checkout__total-row">
                        <div class="checkout__total-row-left">
                            <div class="text_body-small checkout__total-row-title">Gift Note</div>
                        </div>
                        <div class="checkout__total-row-right">
                            <span class="text_caption checkout__total-row-quantity">x1</span>
                            <span class="text_body-small checkout__total-row-price">Free</span>
                        </div>
                    </div> -->
                    <div class="checkout__total-row">
                        <div class="checkout__total-row-left">
                            <div class="text_body-small checkout__total-row-title">Shipping</div>
                        </div>
                        <div class="checkout__total-row-right">
                            <div class="cart__total-prop-desc-wrapper">
                                <span class="text_body-small checkout__total-row-quantity"><?=WC()->cart->get_cart_shipping_total();?></span>
                                <span class="text_caption cart__total-prop-desc-secondary" data-portal-click="#shipping_accordeon">+ Duties & Taxes <img class="uk-preserve" src="<?=get_template_directory_uri()?>/assets/images/icons/question.svg" uk-svg></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="checkout__main-total-row checkout__main-total-row_modal">
                    <div class="checkout__main-total-row-left">
                        <span class="text_body checkout__main-total-row-title">
                            <strong>Total</strong>
                        </span>
                    </div>
                    <div class="checkout__main-total-row-right">
                        <span class="text_body checkout__main-total-row-price"><?=wc_cart_totals_order_total_html();?></span>
                        <span class="text_caption checkout__main-total-row-desc">VAT Included</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<? endif; ?>

<div class="cart-widget" id="cart-widget" uk-modal>
    <div class="uk-modal-dialog uk-modal-body cart-widget__wrapper container">
        <div class="cart-widget__body">
            <div class="text_h3 cart-widget__title">Added to Cart</div>
            <button class="uk-modal-close cart-widget__close uk-icon uk-close" type="button">
                <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1 1L15 15M1 15L15 1" stroke="#1D1D1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>

            <div class="checkout__total-products cart-widget__products">
                <? foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ): ?>
                    <?
                        $tud_id = $cart_item['product_id'];
                        $tud = wc_get_product($tud_id);
                        $collection = get_field('collection', $tud_id);
                        $is_collectors_sets = get_field('is_collectors_sets', $tud_id);

                        $size_label = get_field('size_label', $tud_id);

                        $price = $cart_item['line_total'];
                        if($price == 0) {
                            $price = 'FREE';
                        }
                        else {
                            $price = '$' . $price;
                        }
                    ?>
                    <div class="checkout__total-product-row">
                        <img src="<?=get_field('avatar', $tud_id)['sizes']['thumbnail'];?>" class="checkout__total-avatar">
                        <div class="checkout__total-product-info">
                            <div class="checkout__total-product-row-left">
                                <? if(!empty(get_field('text_instead_of_price', $tud_id))): ?>
                                    <span class="text_body-small checkout__total-product-name"><?=$tud->get_name()?></span>
                                <? else: ?>
                                    <span class="text_body-small checkout__total-product-name">TUD x <?=get_the_title($collection)?></span>
                                <? endif; ?>
                                
                                <? if ( !$is_collectors_sets ) : ?>
                                    <span class="text_caption-small checkout__total-product-props">Size <?=get_field('size_label', $tud_id)?> / <?=get_field('dimensions_mm', $tud_id)['height']?> mm</span>
                                <? else : ?>
                                    <? $i = 0; ?>

                                    <? if( have_rows('size', $tud_id) ): ?>
                                        <span class="text_caption-small checkout__total-product-props">
                                            <? while( have_rows('size', $tud_id) ) : the_row(); ?>
                                                <? 
                                                    $size_label = get_sub_field('size_label');
                                                    $size_add_text = get_sub_field('size_add_text');
                                                ?>
                                                Size <?=$size_label?> / <?=get_sub_field('dimensions_mm')['height']?> mm
                                                <? if ($i == 0) : ?>
                                                    + 
                                                <? endif; ?>

                                                <? $i++; ?>
                                            <? endwhile; ?>
                                        </span>
                                    <? endif; ?>
                                <? endif; ?>
                            </div>
                            <div class="checkout__total-product-row-right">
                                <span class="text_caption checkout__total-product-quantity">x<?=$cart_item['quantity']?></span>
                                <span class="text_body-small checkout__total-product-price"><?=$price?></span>
                            </div>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
            <div class="cart-widget__buttons">
                <a href="/cart/" class="btn cart-widget__cart-button text_btn">View Cart</a>
                <button class="btn cart-widget__cancel text_btn">Continue</button>
            </div>
        </div>
        
    </div>
</div>




<? get_template_part('templates/gtag'); ?>

<? wp_footer(); ?>
</body>
</html> 