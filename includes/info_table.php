<section class="info-table">
    <div class="container info-table__container">
        <h2 class="info-table__title text_h1-bold"><?=$args['title']?></h2>
        <img src="<?=$args['icon']['url']?>" class="info-table__img">
        <div class="info-table__table">
            <? foreach($args['table'] as $row): ?>
                <div class="info-table__row">
                    <div class="text_body info-table__row-left">
                        <?=$row['title']?>
                        <? if($row['is_size']): ?>
                            <div class="size-icon size-icon_dark" uk-tooltip="title: <?=$row['text']?>; offset: 5px; cls: uk-active dark;">
                                <img src="<?=get_template_directory_uri()?>/assets/images/icons/size-<?=strtolower($row['size'])?>.svg" uk-svg>
                            </div>
                        <? endif; ?>
                    </div>
                    <div class="text_body info-table__row-right"><?=$row['text']?></div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>