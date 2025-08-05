<?

$params = array(
	'post_type' => 'post',
	'posts_per_page' => 9,
);

$posts = get_posts( $params )

?>

<section class="news">
    <div class="container news__container">
        <div class="news__header" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <h2 class="text_h1-medium news__title"><?=$args['title']?></h2>
            <? if(!empty($args['link'])): ?>
                <a href="<?=$args['link']['url']?>" target="<?=$args['link']['target']?>" class="text_link underline news__link">
                    <?=$args['link']['title']?>
                </a>
            <? endif; ?>
        </div>
        <div class="swiper news__swiper" uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <div class="swiper-wrapper">
                <? foreach($posts as $post):?>
                    <? 
                        $postID = $post->ID; 

                        $link = get_permalink($post->ID);
                        $target = '';
                        if(get_field('is_external_post', $postID)) {
                            $link = get_field('external_link', $postID);
                            $target = '_blank';
                        }
    
                        $upcoming_class = '';
                        if(get_field('is_upcoming', $postID)) {
                            $upcoming_class = 'news-card_upcoming';
                        }
                    
                    ?>
                    
                    <a href="<?=$link?>" target="<?=$target?>" class="swiper-slide news-card <?=$upcoming_class?>">
                        <img src="<?=get_the_post_thumbnail_url($postID, 'large');?>" class="news-card__image">
                        <div class="news-card__info">
                            <span class="news-card__date text_body"><?=get_the_date();?></span>
                            <? if(!empty(get_field('external_name', $postID))): ?>
                                <div class="news-card__separator"></div>
                                <span class="news-card__category text_body"><?=get_field('external_name', $postID)?></span>
                            <? endif; ?>
                        </div>
                        <span class="text_body news-card__text"><?=get_the_title($postID);?></span>
                        <? if(get_field('is_upcoming', $postID)): ?>
                            <div class="news-card__tag text_caption-small">Upcoming</div>
                        <? endif; ?>
                    </a>
                <? endforeach; ?>
                
            </div>
            <? if(count($posts) >= 4): ?>
                <div class="btn-group btn-group_white news__btn-group">
                    <button class="btn btn_control btn_white news__btn-control news__btn-control_prev">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                    </button>
                    <button class="btn btn_control btn_white news__btn-control news__btn-control_next">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                    </button>
                </div>
            <? endif; ?>
        </div>
    </div>
</section>