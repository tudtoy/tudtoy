<?
get_header();

if(!empty(get_field('top_content'))) {
    
    foreach(get_field('top_content')['content'] as $block) {
        get_template_part('includes/' . $block['acf_fc_layout'], null, $block);
    } 
}

?>


<section class="news-detail">
    <div class="container news-detail__container">
        <h1 class="text_h1-medium news-detail__title"><?=get_the_title()?></h1>
        <? if(!empty(get_field('post_content'))): ?>
            <? foreach(get_field('post_content') as $block): ?>
                <?
                    
                    switch ($block['acf_fc_layout']) {
                        case 'get_tickets':
                            ?>
                                <div class="news-detail__tickets">
                                    <img src="<?=$block['image']['url']?>" class="news-detail__tickets-img">
                                    <span class="text_h3 news-detail__tickets-title"><?=$block['title']?></span>
                                    <span class="text_body news-detail__tickets-text"><?=$block['text']?></span>
                                    <? if(!empty($block['links'])): ?>
                                        <div class="news-detail__tickets-links">
                                            <? foreach($block['links'] as $link): ?>
                                                <a href="<?=$link['link']['url']?>" target="<?=$link['link']['target']?>" class="text_link underline news-detail__tickets-link"><?=$link['link']['title']?></a>
                                            <? endforeach; ?>
                                        </div>
                                    <? endif; ?>
                                    <? if(!empty($block['button'])): ?>
                                        <a href="<?=$block['button']['url']?>" target="<?=$block['button']['target']?>" class="btn text_btn news-detail__tickets-btn"><?=$block['button']['title']?></a>
                                    <? endif ?>
                                </div>
                            <?
                            break;
                        case 'gallery':
                            if(empty($block['gallery'])) {
                                break;
                            }

                            $small_class = '';
                            if(count($block['gallery']) >= 4) {
                                $small_class = "news-detail__adaptive-grid_small";
                            }
                            ?>
                                    <div class="news-detail__adaptive-grid <?=$small_class?>">
                                    <? foreach($block['gallery'] as $image): ?>
                                        <img src="<?=$image['url']?>" class="news-detail__adaptive-grid-img">
                                    <? endforeach; ?>
                                </div>
                            <?
                            
                            break;
                        case 'text_block':
                            ?>
                                <div class="news-detail__text-block">
                                    <h2 class="text_h2 news-detail__text-block-title"><?=$block['title']?></h2>
                                    <p class="text_body news-detail__text-block-text"><?=$block['text']?></p>
                                </div>
                            <?
                            break;
                        case 'swiper_gallery':
                            ?>
                                <div class="swiper news-detail__swiper">
                                    <div class="swiper-wrapper news-detail__swiper-wrapper">
                                        <? foreach($block['gallery'] as $image): ?>
                                            <img src="<?=$image['url']?>" class="swiper-slide news-detail__swiper-img">
                                        <? endforeach; ?>
                                    </div>
                                    <div class="news-detail__swiper-nav">
                                        <button class="btn btn_control btn_white news-detail__swiper-nav-button news-detail__swiper-nav-button_prev">
                                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                                        </button>
                                        <button class="btn btn_control btn_white news-detail__swiper-nav-button news-detail__swiper-nav-button_next">
                                            <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                                        </button>
                                    </div>
                                </div>
                            <?
                            break;
                        case 'blockquote':
                            ?>
                                <div class="news-detail__blockquote">
                                    <div class="news-detail__blockquote-content">
                                        <img src="<?=$block['icon']['url']?>" class="news-detail__blockquote-icon">
                                        <h2 class="text_h2 news-detail__blockquote-title"><?=$block['title']?></h2>
                                        <span class="text_h3 news-detail__blockquote-name"><?=$block['name_or_subtitle']?></span>
                                        <span class="text_body news-detail__blockquote-description"><?=$block['description']?></span>
                                    </div>
                                </div>
                            <?
                            break;
                    }
                ?>
            <? endforeach; ?>
        <? endif; ?>

        <div class="news-detail__form">
            <h2 class="text_h1-medium news-detail__form-title">Don’t Miss a Moment</h2>
            <span class="text_body news-detail__form-text">Join our mailing list to be the first to know about upcoming events, exclusive launches, and more.</span>
            <form class="news-detail__form-form ajax-form">
                <label class="input__label news-detail__input">
                    <input type="text" name="email" class="text_body-small input input_checkout input_required">
                    <span class="text_body-small input__placeholder">Email</span>
                    <span class="input__error-text text_caption-small"></span>
                </label>
                <button class="btn news-detail__form-btn btn_with-load">
                    <span class="text_btn btn__text">Subscribe</span>
                    <div class="btn__loader-wrapper">
                        <span class="loader"></span>
                    </div>
                </button>
            </form>
        </div>
    </div>
</section>

<?
get_footer();
?>