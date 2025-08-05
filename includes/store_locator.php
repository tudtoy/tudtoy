<section class="accordion store-locator">
    <div class="container accordion__container">
        <h2 class="accordion__title text_h1-medium"><?=$args['title']?></h2>
        <span class="text_body accordion__text"><?=$args['text']?></span>
        <ul class="accordion__list">
            <? foreach($args['list'] as $elem): ?>
                <li class="accordion__elem">
                    <a class="accordion__elem-title-wrapper" href>
                        <h3 class="accordion__elem-title">
                            <span class="text_h3"><?=$elem['title']?></span>
                            <span class="text_h3 accordion__elem-title-secondary"><?=$elem['secondary_title']?></span>
                            <? if($elem['is_coming_soon']): ?>
                                <span class="text_link accordion__elem-title-tag text_mobile_caption-small">coming soon</span>
                            <? endif; ?>
                        </h3>
                        <img src="<?=get_template_directory_uri()?>/assets/images/icons/plus.svg" class="accordion__elem-plus" uk-svg>
                    </a>
                    <div class="accordion__elem-content">
                        <p class="text_body accordion__elem-text"><?=$elem['content']?></p>
                        <div class="accordion__elem-grid">
                            <? foreach($elem['schedule'] as $line): ?>
                                <span class="text_body-small accordion__elem-grid-label"><?=$line['day']?></span>
                                <span class="text_body-small accordion__elem-grid-value"><?=$line['hours']?></span>
                            <? endforeach; ?>
                        </div>
                        <div class="accordion__elem-link-row">
                            <? foreach($elem['links'] as $line): ?>
                                <a href="<?=$line['link']['url']?>" target="<?=$line['link']['target']?>" class="text_link underline accordion__elem-link"><?=$line['link']['title']?></a>
                            <? endforeach; ?>
                        </div>
                    </div>
                </li>
            <? endforeach; ?>
        </ul>
    </div>
</section>