<? 
    $products = wc_get_products([
        'limit' => $args['number_of_tuds'],
        //'limit' => -1,
        'status' => 'publish',
    ]);

    $tuds = [];

    // Stack TUDs if collection "is_stack"
    foreach($products as $tud) {
        $tud_id = $tud->get_id();
        $collection = get_field('collection', $tud_id);
        $collection_id = $collection->ID;

        $is_stack = true; //get_field('is_stack', $collection_id);
        if(!empty($tuds[$collection_id])) {
            $tuds[$collection_id]['tuds'][] = $tud;
        }
        else {
            $tuds[$collection_id]['tuds'] = [$tud];
            $tuds[$collection_id]['stack'] = $is_stack;
        }
    }
    
?>

<section class="catalog">
    <div class="container catalog__container">
        <div uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <h1 class="catalog__title text_h1-bold"><?=$args['title']?></h1>
            <span class="text_h3 catalog__subtitle"><?=$args['subtitle']?></span>
        </div>
        <div class="catalog__grid" uk-scrollspy="target: > .catalog-item; cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <? $tud_card_count = 0; ?>
            <? foreach($products as $tud): ?>
                <?
                    include('product-card.php');
                ?>
            <? endforeach; ?>
        </div>
        <div uk-scrollspy="cls: uk-animation-fade uk-animation-slide-bottom-small;">
            <span class="text_h1-medium catalog__full-store-title">
                <?=$args['bottom_title'][0]['line']?>
                <b><?=$args['bottom_title'][1]['line']?></b>
            </span>
            <? if(isset($args['bottom_button'])): ?>
                <a href="<?=$args['bottom_button']['url']?>" target="<?=$args['bottom_button']['target']?>" class="btn text_btn catalog__full-store-btn">
                    <?=$args['bottom_button']['title']?>
                </a>
            <? endif; ?>
        </div>
    </div>
</section>