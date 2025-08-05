<?
$products = wc_get_products([
    'limit' => -1,
    'status' => 'publish',
    'exclude' => [get_the_ID()],
]);

$tuds = [];

// Stack TUDs if collection "is_stack"
foreach($products as $tud) {
    $tud_id = $tud->get_id();
    $collection = get_field('collection', $tud_id);
    $collection_id = $collection->ID;

    $is_stack = get_field('is_stack', $collection_id);
    if(!empty($tuds[$collection_id])) {
        $tuds[$collection_id]['tuds'][] = $tud;
    }
    else {
        $tuds[$collection_id]['tuds'] = [$tud];
        $tuds[$collection_id]['stack'] = $is_stack;
    }
}

?>

<section class="similar-products">
    <div class="container similar-products__container">
        <h2 class="similar-products__title text_h1-medium"><?=$args['title']?></h2>
        <div class="swiper similar-products__swiper">
            <div class="swiper-wrapper similar-products__swiper-wrapper">
                <? $tud_card_count = 0; ?>
                <? foreach($tuds as $stack_tud): ?>
                    <?
                        if($tud_card_count >= $args['number_of_tuds']) {
                            break;
                        }    
                    ?>

                    <? if(!$stack_tud['stack']): ?>
                        <? foreach($stack_tud['tuds'] as $tud): ?>
                            <?
                                if($tud_card_count >= $args['number_of_tuds']) {
                                    break;
                                }
                                $tud_card_count++;
                                $tud_product_add_class = 'swiper-slide similar-products__slide';
                            ?>

                            <? include('product-card.php'); ?>
                        <? endforeach; ?>
                    <? else: ?>
                        <? 
                            $tud_card_count++;
                            $tud = $stack_tud['tuds'][0];

                            $tud_product_add_class = 'swiper-slide similar-products__slide';

                            include('product-card-variable.php');
                        ?>
                    <? endif; ?>

                    <?/* 
                        $tud_id = $tud->get_id();
                        $collection_id = get_field('collection', $tud_id);

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

                        $image = get_field('preview_gallery', $tud_id)[0];
                    ?>
                    <div class="swiper-slide similar-products__slide">
                        <a href="<? the_permalink($tud_id) ?>">
                            <div class="swiper-slide catalog-item__slide">
                                <img src="<?=$image['sizes']['1536x1536']?>">
                            </div>
                        </a>
                        <a href="<?the_permalink($tud_id)?>" class="text_body catalog-item__title">TUD x <?=get_the_title($collection_id);?></a>
                        <div class="catalog-item__info">
                            <span class="text_body catalog-item__price"><?=$tud->get_price_html();?></span>
                            <div class="catalog-item__separator"></div>
                            <span class="text_body catalog-item__size">
                            <span class="text_body">Size</span>
                            <div class="catalog-item__size-icon size-icon" uk-tooltip="title: <?=get_field('dimensions_mm', $tud_id)['height']?> mm / <?=get_field('dimensions_inch', $tud_id)['height']?> inch; offset: 5px;">
                                <img src="<?=get_template_directory_uri()?>/assets/images/icons/<?=$size_image?>" uk-svg>
                            </div>
                            </span>
                        </div>
                    </div>*/?>
                <? endforeach; ?>
            </div>
        </div>
        <div class="similar-products__buttons">
            <button class="btn btn_control btn_white similar-products__nav-button similar-products__nav_prev">
                <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
            </button>
            <button class="btn btn_control btn_white similar-products__nav-button similar-products__nav_next">
                <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
            </button>
        </div>
    </div>
</section>