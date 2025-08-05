<section class="hero">
    <div class="hero__overflow"></div>
    <? if($args['pc_video']['type'] == 'image'): ?>
        <picture class="hero__video">
            <? if(!empty($args['mobile_video'])): ?>
                <source srcset="<?=$args['mobile_video']['url']?>" media="(max-width:768px)">
            <? endif; ?>
            <? if(!empty($args['pc_video'])): ?>
                <img src="<?=$args['pc_video']['url']?>">
            <? endif; ?>
        </picture>
    <? else: ?>
        <video class="hero__video" autoplay loop muted playsinline>
            <? if(!empty($args['mobile_video'])): ?>
                <source src="<?=$args['mobile_video']['url']?>" type="video/mp4" media="(max-width:768px)">
            <? endif; ?>
            <? if(!empty($args['pc_video'])): ?>
                <source src="<?=$args['pc_video']['url']?>" type="video/mp4">
            <? endif; ?>
        </video>
    <? endif; ?>
</section>