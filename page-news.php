<?
get_header();

$params = array(
	'post_type' => 'post',
	'posts_per_page' => -1,
);

$posts = get_posts( $params );

?>

<section class="news-list">
    <div class="container news-list__container" uk-filter="target: .news-list__grid" data-switcher>
        <h1 class="news-list__title text_h1-medium">News & Events</h1>
        <div class="news-list__switcher switcher switcher_white">
            <button class="text_body-small btn switcher__btn" uk-filter-control>All</button>
            <button class="text_body-small btn switcher__btn" uk-filter-control="[data-tags*='Media']">Media</button>
            <button class="text_body-small btn switcher__btn" uk-filter-control="[data-tags*='Events']">Events</button>
            <div class="switcher__back"></div>
        </div>
        <div class="news-list__grid">
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

                <a href="<?=$link?>" target="<?=$target?>" class="news-card <?=$upcoming_class?>" data-tags="<?=get_field('tag', $postID)?>">
                    <img src="<?=get_the_post_thumbnail_url($postID, 'large');?>" class="news-card__image">
                    <div class="news-card__info">
                        <span class="text_body news-card__date"><?=get_the_date();?></span>
                        <? if(get_field('is_external_post', $postID)): ?>
                            <div class="news-card__separator"></div>
                            <span class="text_body news-card__category"><?=get_field('external_name', $postID)?></span>
                        <? endif; ?>
                    </div>
                    <span class="text_body news-card__text"><?=get_the_title($postID);?></span>
                    <? if(get_field('is_upcoming', $postID)): ?>
                        <div class="news-card__tag text_caption-small">Upcoming</div>
                    <? endif; ?>
                </a>
            <? endforeach; ?>
        </div>
    </div>
</section>

<?
if(!empty(get_field('content'))) {
    foreach(get_field('content') as $block) {
        get_template_part('includes/' . $block['acf_fc_layout'], null, $block);
    } 
}

get_footer();
?>