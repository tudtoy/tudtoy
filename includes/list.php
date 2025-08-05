<section class="list">
    <div class="list__container container">
        <? if($args['title']): ?>
            <h1 class="text_h1-medium list__title"><?=$args['title']?></h1>
        <? endif; ?>
        <? if($args['list']): ?>
            <div class="list__content">
                <? foreach($args['list'] as $list_elem): ?>
                    <div class="list__elem">
                        <h2 class="list__elem-title text_h2"><?=$list_elem['title']?></h2>
                        <div class="list__elem-content custom-list text_body">
                            <?=$list_elem['content']?>
                        </div>
                    </div>
                <? endforeach; ?>
            </div>
        <? endif; ?>
    </div>
</section>