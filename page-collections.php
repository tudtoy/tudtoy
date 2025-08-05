<?
get_header();
?>

<?
    $collections = get_posts([
        'post_type' => 'collection',
        'posts_per_page' => -1,  
    ]);

?>

<section class="all-collections">
    <div class="container all-collections__container" uk-filter="target: .all-collections__cards" data-switcher>
        <h1 class="all-collections__title text_h1-medium">Collections</h1>
        <div class="all-collections__switcher switcher">
            <a href uk-filter-control class="btn switcher__btn">All</a>
            <a href uk-filter-control="[data-tags*='Legend']" class="btn switcher__btn">Legends</a>
            <a href uk-filter-control="[data-tags*='Art']" class="btn switcher__btn">Art</a>
            <a href uk-filter-control="[data-tags*='Brand']" class="btn switcher__btn">Brands</a>
            <div class="switcher__back"></div>
        </div>
        <div class="all-collections__cards">
            <? foreach($collections as $collection): ?>
                <?
                    $tuds = get_field('products', $collection);
                    if(!empty($tuds[0])) {
                        $tud = $tuds[0];

                        $tags = get_field('tags', $collection);
                        if(!empty($tags)) {
                            $tags = implode(' ', $tags);
                        }                        

                        ?>
                            <div class="all-collections-card all-collections__card" data-tags="<?=$tags?>">
                                <div class="all-collections-card__info">
                                    <div class="all-collections-card__text-wrapper">
										<?
											$name = get_the_title($collection);
											if(get_field('prefix', $collection)) {
												$name = 'TUD x ' . $name;
											}
										?>
                                        <h2 class="text_h2 all-collections-card__title"><?=$name?></h2>
                                        <span class="text_body all-collections-card__text"><?=get_field('preview_description_all_collections', $collection);?></span>    
                                    </div>
                                    <div class="all-collections-card__link-row">
                                        <a href="<?=get_permalink($collection)?>" class="text_link underline all-collections-card__link">Explore collection</a>
                                        <a href="<?=get_permalink($tud)?>" class="text_link underline all-collections-card__link">Buy Now</a>
                                    </div>
                                </div>
                                <img src="<?=get_field('preview_image_all_collections', $collection)['sizes']['large'] ?>" class="all-collections-card__img">
                            </div>
                        <?
                    }
                ?>
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