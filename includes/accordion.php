<section class="accordion <?=($args['dark_theme'] ? 'accordion_dark' : '')?>">
    <div class="container accordion__container">
        <h2 class="<?=($args['dark_theme'] ? 'text_h2' : 'text_h1-medium')?> accordion__title"><?=$args['title']?></h2>
        <ul class="accordion__list">
            <? foreach($args['accordion_elems'] as $elem): ?>
                <li class="accordion__elem">
                    <a class="accordion__elem-title-wrapper" href>
                        <h3 class="text_h3 accordion__elem-title"><?=$elem['title']?></h3>
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" class="accordion__elem-plus" uk-svg>
                    </a>
                    <div class="accordion__elem-content">
                        <div class="text_body accordion__elem-text">
                            <?=$elem['content']?>
                        </div>
                        <? if(!empty($elem['links'])): ?>
                            <div class="accordion__elem-link-row">
                                <? foreach($elem['links'] as $link): ?>
                                    <a href="<?=$link['link']['url']?>" target="<?=$link['link']['target']?>" class="text_link accordion__elem-link underline">
                                        <?=$link['link']['title']?>
                                    </a>
                                <? endforeach; ?>
                            </div>
                        <? endif; ?>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</section>