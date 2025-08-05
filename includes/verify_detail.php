<? 
    $tudSlug = get_query_var('tud');
    $tudPost = get_page_by_path($tudSlug, OBJECT, 'product');
    $tudID = $tudPost->ID;
    $tud = wc_get_product($tudID);
    $collection = get_field('collection', $tudID);

    $size_label = get_field('size_label', $tudID); 
    if($size_label == 'S') {
        $size_image = 'size-s.svg';
    }
    elseif($size_label == 'M') {
        $size_image = 'size-m.svg';
    }
    elseif($size_label == 'L') {
        $size_image = 'size-l.svg';
    }
?>

<section class="verify-detail">
    <div class="container verify-detail__container">
        <div class="verify-detail__left">
            <a href="/" class="verify-detail__logo-wrapper">
                <img src="<?=get_template_directory_uri()?>/assets/images/logo.svg" class="verify-detail__logo" uk-svg>
            </a>
            <div class="verify-detail__video-wrapper" uk-sticky="end: true; offset: 160px; media: 768;">
                <video src="<?=get_field('video_360', $tudID)['url']?>" class="verify-detail__video" muted autoplay playsinline loop></video>
            </div>
            
        </div>
        <div class="verify-detail__right">
            <div class="verify-detail__links">
                <a href="<?=get_permalink($collection)?>" class="underline text_link verify-detail__link">about collection</a>
                <a href="<?=get_permalink($tudID);?>" class="underline text_link verify-detail__link">View in Store</a>
            </div>
            <div class="verify-detail__info">
                <div class="verify-detail__titles">
                    <? /* Sample TUD */ ?>
                    <? if($tudID == 1800): ?>
                        <h1 class="text_h2 text_mobile_h1-medium verify-detail__title"><?=$tud->get_name()?></h1>
                    <? else: ?>
                        <h1 class="text_h2 text_mobile_h1-medium verify-detail__title">TUD x <?=get_the_title($collection)?></h1>
                        <h2 class="text_h2 text_mobile_h1-medium verify-detail__name"><?=$tud->get_name()?></h2>
                    <? endif; ?>
                    <span class="verify-detail__size">
                        <span class="text_h3 verify-detail__size-text">Size</span>
                        <div class="size-icon verify-detail__size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tudID)['height']?> mm / <?=get_field('dimensions_inch', $tudID)['height']?> inch; offset: 5px;">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                        </div>
                    </span>
                </div>
                <form class="verify-detail__verify">
                    <span class="text_h3 text_mobile_h2 verify-detail__verify-title">Verification</span>
                    <span class="text_body-small text_mobile_body verify-detail__verify-text">Your certificate has the Unique Identifier for your TUD. Use it to verify and learn more about your art piece by entering it below.</span>
                    <div class="verify-detail__verify-input verify__input-wrapper">
                        <label class="input__label verify__label">
                            <input type="text" name="code" class="text_body input verify__input">
                            <span class="text_body input__placeholder verify__placeholder">Unique Identifier</span>
                        </label>
                        <button class="btn text_btn verify-detail__btn verify__btn btn_with-load hidden-mobile">
                            <span class="btn__text">Verify</span>
                            <div class="btn__loader-wrapper">
                                <span class="loader"></span>
                            </div>
                        </button>
                        <div class="verify__success">
                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/egg-check.svg" class="verify__success-icon" uk-svg>
                            <span class="verify__success-text text_btn">Verified</span>
                        </div>
                    </div>
                    <div class="verify-detail__success">
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Product number</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value verify-detail__res-number"></span>
                        </div>
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Timestamp</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value verify-detail__res-timestamp"></span>
                        </div>
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Unique identifier</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value verify-detail__res-code"></span>
                        </div>
                    </div>
                    <div class="verify-detail__error">
                        <span class="text_mobile_body text_body_small verify__error-text">
                            Invalid Verification Code.<br> Try again or <a href="#support" uk-toggle class="underline verify__error-link">contact support.</a>
                        </span>
                    </div>
                    <button class="btn text_btn verify-detail__btn verify__btn show-mobile btn_with-load">
                        <span class="btn__text">Verify</span>
                        <div class="btn__loader-wrapper">
                            <span class="loader"></span>
                        </div>
                    </button>
                    <div class="verify__success verify__success_mobile show-mobile">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/egg-check.svg" class="verify__success-icon" uk-svg>
                        <span class="verify__success-text text_btn">Verified</span>
                    </div>
                </form>
                <div class="verify-detail__details">
                    <span class="text_body verify-detail__details-title">Product Details</span>
                    <div class="verify-detail__details-props">
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Limited edition</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value"><?=get_field('quantity', $tudID)?> pieces only</span>
                        </div>
                        <? 
                            $tud_size_mm = get_field('dimensions_mm', $tudID);
                            $tud_size_inch = get_field('dimensions_inch', $tudID);
                            $box_size_mm = get_field('box_size_mm', $tudID);
                            $box_size_inch = get_field('box_size_inch', $tudID);

                            $tud_size_mm_array = [];
                            if(!empty($tud_size_mm['length'])) {
                                $tud_size_mm_array[] = $tud_size_mm['length'];
                            }
                            if(!empty($tud_size_mm['width'])) {
                                $tud_size_mm_array[] = $tud_size_mm['width'];
                            }
                            if(!empty($tud_size_mm['height'])) {
                                $tud_size_mm_array[] = $tud_size_mm['height'];
                            }

                            $tud_size_inch_array = [];
                            if(!empty($tud_size_mm['length'])) {
                                $tud_size_inch_array[] = $tud_size_inch['length'];
                            }
                            if(!empty($tud_size_mm['width'])) {
                                $tud_size_inch_array[] = $tud_size_inch['width'];
                            }
                            if(!empty($tud_size_mm['height'])) {
                                $tud_size_inch_array[] = $tud_size_inch['height'];
                            }

                            $box_size_mm_array = [];
                            if(!empty($box_size_mm['length'])) {
                                $box_size_mm_array[] = $box_size_mm['length'];
                            }
                            if(!empty($box_size_mm['width'])) {
                                $box_size_mm_array[] = $box_size_mm['width'];
                            }
                            if(!empty($box_size_mm['height'])) {
                                $box_size_mm_array[] = $box_size_mm['height'];
                            }

                            $box_size_inch_array = [];
                            if(!empty($box_size_inch['length'])) {
                                $box_size_inch_array[] = $box_size_inch['length'];
                            }
                            if(!empty($box_size_inch['width'])) {
                                $box_size_inch_array[] = $box_size_inch['width'];
                            }
                            if(!empty($box_size_inch['height'])) {
                                $box_size_inch_array[] = $box_size_inch['height'];
                            }

                        ?>
                        <? if(!empty($tud_size_mm_array)): ?>
                            <div class="verify-detail__details-prop">
                                <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Dimensions</span>
                                <span class="text_body-small text_mobile_body verify-detail__details-prop-value">
                                    <?=implode(" x ", $tud_size_mm_array)?> mm / <?=implode(" x ", $tud_size_inch_array)?> inch
                                </span>
                            </div>
                        <? endif; ?>
                        <? if(!empty($box_size_mm_array)): ?>
                            <div class="verify-detail__details-prop">
                                <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Box size</span>
                                <span class="text_body-small text_mobile_body verify-detail__details-prop-value">
                                    <?=implode(" x ", $box_size_mm_array)?> mm / <?=implode(" x ", $box_size_inch_array)?> inch
                                </span>
                            </div>
                        <? endif; ?>
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Wieght</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value"><?=get_field('weight_kg', $tudID)?> kg / <?=get_field('weight_lbs', $tudID)?> lbs</span>
                        </div>
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Packaging</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value">Premium Collector Gift Box</span>
                        </div>
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Manufacturer</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value">TUD TOY GIFTS TRADING L.L.C</span>
                        </div>
                        <div class="verify-detail__details-prop">
                            <span class="text_body-small text_mobile_caption verify-detail__details-prop-title">Materials</span>
                            <span class="text_body-small text_mobile_body verify-detail__details-prop-value"><?=get_field('materials', $tudID)?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>