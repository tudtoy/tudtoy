<section class="fullscreen-video">
<video class="fullscreen-video__video" muted autoplay loop playsinline>
        <source src="<?=$args['mobile_video']['url']?>" media="(max-width: 768px)">
        <source src="<?=$args['video']['url']?>">
    </video>
    <div class="fullscreen-video__btn">
        <img src="<?=get_template_directory_uri()?>/assets/images/icons/mute.svg" data-icon="<?=get_template_directory_uri()?>/assets/images/icons/volume.svg" class="fullscreen-video__icon">
    </div>
</section>