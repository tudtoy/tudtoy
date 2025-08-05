<section class="contacts">
    <div class="container contacts__container">
        <h1 class="text_h1-medium contacts__title"><?=$args['title']?></h1>
        <span class="text_body contacts__text"><?=$args['subtitle']?></span>
        <div class="contacts__grid">
            <? foreach($args['cards'] as $card): ?>
                <div class="contacts__card">
                    <div class="contacts__card-info">
                        <h2 class="contacts__card-title text_h3"><?=$card['title']?></h2>
                        <span class="text_body-small contacts__card-text"><?=$card['text']?></span>    
                    </div>
                    <? if(!empty($card['links'])): ?>
                        <div class="contacts__card-links">
                            <? foreach($card['links'] as $link): ?>
                                
                                <? if($card['is_icons']): ?>
                                    <a href="<?=$link['link']['url']?>" target="<?=$link['link']['target']?>" class="contacts__card-link">
                                        <img src="<?=$link['icon']['url']?>" class="contacts__card-link-icon">
                                    </a>
                                <? else: ?>
                                    <a href="<?=$link['link']['url']?>" target="<?=$link['link']['target']?>" class="text_link underline contacts__card-link"><?=$link['link']['title']?></a>
                                <? endif; ?>
                        <? endforeach; ?>
                        </div>
                    <? endif; ?>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</section>