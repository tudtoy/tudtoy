<section class="unboxing">
    <div class="container unboxing__container" data-switcher>
        <h2 class="text_h1-medium parallax-title parallax-title_invert unboxing__title" uk-scrollspy="target: > .limited__title-row; cls: uk-animation-fade; delay: 100; repeat: true">
            <span class="parallax-title__row" uk-parallax="bgx: 100%; start: 20vh; end: 60vh;"><?=$args['title']?></span>
        </h2>
        <? if($args['with_switcher']): ?>
            <? foreach($args['videos'] as $switch_index => $video): ?>
                <video src="<?=$video['video']['url']?>" data-switch="<?=$switch_index?>" class="unboxing__video" autoplay loop muted playsinline></video>
            <? endforeach; ?>
        <? else: ?>
            <video src="<?=$args['unboxing_video']['url']?>" class="unboxing__video" autoplay loop muted playsinline></video>
        <? endif; ?>
        <? if($args['with_switcher']): ?>
            <div class="switcher switcher_white unboxing__switcher">
                <? foreach($args['videos'] as $switch_index => $video): ?>
                    <button class="btn switcher__btn" data-switch-button="<?=$switch_index?>"><?=$video['switch_name']?></button>
                <? endforeach; ?>
                <div class="switcher__back"></div>
            </div>
        <? endif; ?>
    </div>
</section>