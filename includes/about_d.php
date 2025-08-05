<?
$cover_class = '';
$many_class = '';
if($args['is_cover']) {
    $cover_class = 'variable-grid_cover';
}

if(!empty($args['gallery']) && count($args['gallery']) >= 4) {
    $many_class = 'variable-grid_many';
}

if(!empty($args['switches'])) {
    foreach($args['switches'] as $switch) {
        if(!empty($switch['gallery']) && count($switch['gallery']) >= 4) {
            $many_class = 'variable-grid_many';
        }
    }
}

?>

<section class="about-d">
    <div class="container about-d__container" data-switcher>
        <h2 class="text_h1-medium about-d__title"><?=$args['title']?></h2>
        <div class="swiper variable-grid about-d__variable-grid <?=$cover_class?> <?=$many_class?>">
            <div class="swiper-wrapper variable-grid__wrapper">
                <? if($args['with_switcher']): ?>
                    <? foreach($args['switches'] as $switch_index => $switch): ?>
                        <? foreach($switch['gallery'] as $image): ?>
                            <div class="swiper-slide variable-grid__slide" data-switch="<?=$switch_index?>">
                                <img src="<?=$image['sizes']['large']?>" class="variable-grid__img">
                            </div>
                        <? endforeach; ?>
                    <? endforeach; ?>
                <? else: ?>
                    <? foreach($args['gallery'] as $image): ?>
                        <div class="swiper-slide variable-grid__slide">
                            <img src="<?=$image['sizes']['large']?>" class="variable-grid__img">
                        </div>
                    <? endforeach; ?>
                <? endif; ?>
            
            </div>
            <div class="about-d__nav">
            <? if($args['with_switcher']): ?>
                    <div class="switcher about-d__switcher">
                        <? foreach($args['switches'] as $switch_index => $switch): ?>
                            <button class="btn switcher__btn" data-switch-button="<?=$switch_index?>">
                                <?=$switch['switch_name']?>
                            </button>
                        <? endforeach; ?>
                        <div class="switcher__back"></div>
                    </div>
                <? endif; ?>
                <div class="btn-group about-d__buttons <?=(!$args['with_switcher'] ? 'about-d__buttons_center' : '')?>">
                    <button class="btn btn_control about-d__nav-button variable-grid__nav_prev">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-left.svg" uk-svg>
                    </button>
                    <button class="btn btn_control about-d__nav-button variable-grid__nav_next">
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/arrow-right.svg" uk-svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>