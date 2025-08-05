<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">

   <!-- Google Tag Manager -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=AW-16724091888"></script>
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-5TQFTB7C');
	
	window.dataLayer = window.dataLayer || [];
    function gtag(){
        dataLayer.push(arguments);
    }
		
	gtag('js', new Date());
 	gtag('config', 'AW-16724091888');
	</script>
	<!-- End Google Tag Manager -->
     

    <? wp_head(); ?>

    
	
	<!-- TikTok Pixel Code Start -->
	<script>
		!function (w, d, t) {
			w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie","holdConsent","revokeConsent","grantConsent"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(
				var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var r="https://analytics.tiktok.com/i18n/pixel/events.js",o=n&&n.partner;ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=r,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};n=document.createElement("script")
																																	;n.type="text/javascript",n.async=!0,n.src=r+"?sdkid="+e+"&lib="+t;e=document.getElementsByTagName("script")[0];e.parentNode.insertBefore(n,e)};


			ttq.load('CU9SDPJC77U574S3945G');
			ttq.page();
		}(window, document, 'ttq');
	</script>

	<!-- TikTok Pixel Code End -->
	
	<!-- Microsoft Clarity -->
	<script type="text/javascript">
        (function(c,l,a,r,i,t,y){
            c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
            t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
            y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
        })(window, document, "clarity", "script", "pupyc9x04l");
    </script>
	<!-- Microsoft Clarity End -->
	
</head>
<body <?body_class()?>>

	<!-- Google Tag Manager (noscript) -->
	<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5TQFTB7C" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
	<!-- End Google Tag Manager (noscript) -->

<?
    // If first ACF block is video, then make the header transparent
    $transparentClass = '';
    $content = get_field('content');
    if(!empty($content[0]) && ($content[0]['acf_fc_layout'] != 'video')) {
        $transparentClass = 'header__sticky-wrapper_ever';
    }
    if(is_product()) {
        global $product;
        $tud_id = $product->get_ID();
        if(!get_field('only_flex_content', $tud_id)) {
            $transparentClass = 'header__sticky-wrapper_ever';
        }
    }

    // All Collections
    if(get_the_ID() == 864) {
        $transparentClass = 'header__sticky-wrapper_invert';
    }

    // One of a kind
    if ( is_singular( 'one-of-a-kind' ) ){
        $transparentClass = 'header__sticky-wrapper_dark-transparent';
    }

    // Star of Africa
    if(get_the_ID() == 2228 || get_the_ID() == 2287 || get_the_ID() == 2313) {
        $transparentClass = 'header__sticky-wrapper_dark-transparent';
    }

    // Store
    if(get_the_ID() == 872) {
        $transparentClass = 'header__sticky-wrapper_ever';
    }

    // News
    if(get_the_ID() == 1751) {
        $transparentClass = 'header__sticky-wrapper_ever';
    }

    // Contacts
    if(get_the_ID() == 1190) {
        $transparentClass = 'header__sticky-wrapper_invert';
    }

    // About Members Club
    if(get_the_ID() == 1867) {
        $transparentClass = 'header__sticky-wrapper_invert';
    }

    if(is_cart()) {
        $transparentClass = 'header__sticky-wrapper_ever';
    }
    if(is_checkout()) {
        $transparentClass = 'header__sticky-wrapper_ever';
    }

    $showHeader = true;

    // Verify NFC Page
    if(get_the_ID() == 1200 && !is_404()) {
        $showHeader = false;
    }

    if(is_404()) {
        $transparentClass = 'header__sticky-wrapper_ever';
    }
?>

<? if($showHeader): ?>
    <header class="header">
        <div class="header__sticky-wrapper <?=$transparentClass?>" uk-sticky="show-on-up: true; animation: uk-animation-slide-top; <?=(is_admin_bar_showing() ? 'offset: 32;' : '')?>">
            <div class="container header__container">
                <div class="header__row">
                    <nav class="header__left" uk-dropnav="delay-hide: 100;">
                        <?
                            wp_nav_menu( array(
                                'menu'              => 'header', // ID, имя или ярлык меню
                                'menu_class'        => 'header__menu hidden-tablet', // класс элемента <ul>
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
                        <!-- <ul class="header__menu hidden-tablet">
                            <li class="text_link underline underline_invert">
                                <a href="#">About</a>
                                <ul class="uk-dropdown">
                                    <li class="uk-active"><a href="#">Active</a></li>
                                    <li><a href="#">Item</a></li>
                                    <li><a href="#">Item</a></li>
                                </ul>
                            </li>
                            <li class="text_link underline underline_invert">
                                <a href="/store/">Store</a>
                            </li>
                            <li class="text_link underline underline_invert">
                                <a href="/collections/">Collections</a>
                            </li>
                            <li class="text_link underline underline_invert">
                                <a href="#">Contact</a>
                            </li>
                        </ul> -->
                        <a href="#burger-menu" uk-toggle class="show-tablet burger header__burger">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/menu.svg" uk-svg>
                        </a>
                    </nav>
                    <a href="/" class="header__logo-link">
                        <img src="<?=get_template_directory_uri()?>/assets/images/logo.svg" class="header__logo" uk-svg>
                    </a>
                    <div class="header__right">
                        <a href="/about-members-club/" class="text_link header__link hidden-mobile">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/paw.svg" class="header__link-icon" uk-svg>
                            <span class="underline underline_invert header__link-text hidden-tablet">Members Club</span>
                        </a>
                        <a href="/cart/" class="text_link header__link header__cart">
                            <? if(WC()->cart->get_cart_contents_count() == 0): ?>
                                <img src="<?=get_template_directory_uri()?>/assets/images/icons/cart-empty.svg" class="header__link-icon header__cart-empty" uk-svg>
                                <img src="<?=get_template_directory_uri()?>/assets/images/icons/cart-full.svg" class="header__link-icon header__cart-full header__cart-hidden" uk-svg>
                            <? else: ?>
                                <img src="<?=get_template_directory_uri()?>/assets/images/icons/cart-empty.svg" class="header__link-icon header__cart-empty header__cart-hidden" uk-svg>
                                <img src="<?=get_template_directory_uri()?>/assets/images/icons/cart-full.svg" class="header__link-icon header__cart-full" uk-svg>
                            <? endif; ?>
                            <span class="underline underline_invert header__link-text hidden-tablet">Cart</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </header>
<? endif; ?>

<main class="main <?php if(is_product()) echo 'main--sticky-product-info' ?>">