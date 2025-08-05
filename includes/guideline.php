<section class="product-use">
    <div class="container product-use__container">
        <div class="product-use__card">
            <h2 class="text_h2 product-use__title"><?=$args['title']?></h2>
            <div class="product-use__elems">
                <? foreach($args['guide_elem'] as $elem): ?>
                    <div class="product-use__elem">
                        <div class="product-use__icon-wrapper">
                            <img src="<?=$elem['icon']['url']?>" class="product-use__icon" uk-svg="stroke-animation: true">
                        </div>
                        <span class="text_body product-use__text"><?=$elem['title']?></span>
                    </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</section>