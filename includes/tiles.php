<div class="tiles">
    <div class="container tiles__container">
        <h2 class="text_h1-medium tiles__title"><?=$args['title']?></h2>
        <div class="tiles__grid">
            <? foreach($args['tiles'] as $tile): ?>
                <div class="tiles__tile-wrapper">
                    <div class="rotate3d tiles__tile">
                        <img src="<?=$tile['icon']['url']?>" class="tiles__tile-icon">
                        <span class="text_h2 tiles__tile-title"><?=$tile['title']?></span>
                        <span class="text_body tiles__tile-text"><?=$tile['text']?></span>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <img src="<?=get_template_directory_uri()?>/assets/images/icons/prisma.svg" class="tiles__circle">
    </div>
</div>