<?
get_header();
?>

<? 
    $tuds = wc_get_products([
        'limit' => -1,
        'status' => 'publish'
    ]); 
?>

<section class="store">
    <div class="container store__container" uk-filter="target: .store__grid">
        <div class="store__header">
            <h1 class="text_h1-medium store__title"><?=get_field('title')?></h1>
            <div class="store__text text_body"><?=get_field('text')?></div>
            <div class="store__dropdown-filters-wrapper">
                <div class="store__dropdown-filters store__dropdown-filters_all">
                    <div class="store__dropdown-filter-btn btn btn_white">
                        <div class="store__dropdown-filter-btn-left text_body">
                            SIZE: <b>ALL</b>
                        </div>
                        <div class="store__dropdown-filter-btn-right">
                            <div class="store__dropdown-filter-btn-right-text text_body"></div>
                            <a href uk-filter-control class="store__dropdown-filter-btn-link">
                                <img class="store__dropdown-filter-btn-close" src="<?=get_template_directory_uri()?>/assets/images/icons/cross.svg" uk-svg>
                            </a>
                        </div>    
                    </div>
                    <a href uk-filter-control class="radio store__dropdown-filter-elem">
                        <input type="radio" name="size" value="All" class="radio__input">
                        <div class="store__dropdown-filter-elem-left">
                            <div class="radio__circle"></div>
                            <span class="radio__placeholder text_body">All</span>
                        </div>
                        <div class="store__dropdown-filter-elem-right text_body"></div>
                    </a>
                    
                    <a href uk-filter-control="filter: [data-size='L'];" class="radio store__dropdown-filter-elem">
                        <input type="radio" name="size" value="L" class="radio__input">
                        <div class="store__dropdown-filter-elem-left">
                            <div class="radio__circle"></div>
                            <span class="radio__placeholder text_body">L</span>
                        </div>
                        <div class="store__dropdown-filter-elem-right text_body" data-btn-text="900 mm / 35.4 in">900 mm / 35.4 in</div>
                    </a>

                    <a href uk-filter-control="filter: [data-size='M'];" class="radio store__dropdown-filter-elem">
                        <input type="radio" name="size" value="M" class="radio__input">
                        <div class="store__dropdown-filter-elem-left">
                            <div class="radio__circle"></div>
                            <span class="radio__placeholder text_body">M</span>
                        </div>
                        <div class="store__dropdown-filter-elem-right text_body" data-btn-text="600 mm / 23.6 in">600 mm / 23.6 in</div>
                    </a>
                    <!-- <a href uk-filter-control="filter: [data-size='S'];" class="radio store__dropdown-filter-elem">
                        <input type="radio" name="size" value="S" class="radio__input">
                        <div class="store__dropdown-filter-elem-left">
                            <div class="radio__circle"></div>
                            <span class="radio__placeholder text_body">S</span>
                        </div>
                        <div class="store__dropdown-filter-elem-right text_body" data-btn-text="300 mm / 11.8 in">300 mm / 11.8 in</div>
                    </a> -->
                    <a href uk-filter-control="filter: [data-size='Unique'];" class="radio store__dropdown-filter-elem">
                        <input type="radio" name="size" value="Unique" class="radio__input">
                        <div class="store__dropdown-filter-elem-left">
                            <div class="radio__circle"></div>
                            <span class="radio__placeholder text_body">Unique</span>
                        </div>
                        <div class="store__dropdown-filter-elem-right text_body" data-btn-text="Variable size">Variable shape & size</div>
                    </a>
                </div>
            </div>
            
            
            
            <!-- <div class="store__filters">
                <a href uk-filter-control class="store__filter_hidden"></a>
                <a href uk-filter-control="filter: [data-tags*='Legend']; group: tags;" class="text_body-small store__filter">Legends</a>
                <a href uk-filter-control="filter: [data-tags*='Art']; group: tags;" class="text_body-small store__filter">Art</a>
                <a href uk-filter-control="filter: [data-tags*='Brand']; group: tags;" class="text_body-small store__filter">Brands</a>
                <a href class="store__filters-separator"></a>
                <a href uk-filter-control="filter: [data-size='L']; group: size;" class="text_body-small store__filter store__filter_circle">L</a>
                <a href uk-filter-control="filter: [data-size='M']; group: size;" class="text_body-small store__filter store__filter_circle">M</a>
            </div> -->
        </div>
        <div class="store__grid">
            <? foreach($tuds as $tud): ?>
                <? include('includes/product-card.php'); ?>
            <? endforeach; ?>
        </div>
    </div>
</section>

<div id="store-mobile-filter" uk-modal>
    <div class="uk-modal-dialog uk-modal-body store__mobile-filter uk-animation-slide-bottom">
        <button class="uk-modal-close-default modal-close" type="button" uk-close></button>
        <h2 class="store__mobile-filter__title text_h2">Choose Your Size</h2>

        <div class="store__mobile-filter__form">
            <label>
                <div class="radio store__dropdown-filter-elem">
                    <input type="radio" name="size" value="All" class="radio__input">
                    <div class="store__dropdown-filter-elem-left">
                        <div class="radio__circle"></div>
                        <span class="radio__placeholder text_body">All</span>
                    </div>
                    <div class="store__dropdown-filter-elem-right text_body"></div>
                </div>
            </label>
            
            <label>
                <div class="radio store__dropdown-filter-elem">
                    <input type="radio" name="size" value="L" class="radio__input">
                    <div class="store__dropdown-filter-elem-left">
                        <div class="radio__circle"></div>
                        <span class="radio__placeholder text_body">L</span>
                    </div>
                    <div class="store__dropdown-filter-elem-right text_body" data-btn-text="900 mm / 35.4 in">900 mm / 35.4 in</div>
                </div>
            </label>
            <label>
                <div class="radio store__dropdown-filter-elem">
                    <input type="radio" name="size" value="M" class="radio__input">
                    <div class="store__dropdown-filter-elem-left">
                        <div class="radio__circle"></div>
                        <span class="radio__placeholder text_body">M</span>
                    </div>
                    <div class="store__dropdown-filter-elem-right text_body" data-btn-text="600 mm / 23.6 in">600 mm / 23.6 in</div>
                </div>
            </label>
            <!-- <div class="radio store__dropdown-filter-elem">
                <input type="radio" name="size" value="S" class="radio__input">
                <div class="store__dropdown-filter-elem-left">
                    <div class="radio__circle"></div>
                    <span class="radio__placeholder text_body">S</span>
                </div>
                <div class="store__dropdown-filter-elem-right text_body" data-btn-text="300 mm / 11.8 in">300 mm / 11.8 in</div>
            </div> -->
            <label>
                <div class="radio store__dropdown-filter-elem">
                    <input type="radio" name="size" value="Unique" class="radio__input">
                    <div class="store__dropdown-filter-elem-left">
                        <div class="radio__circle"></div>
                        <span class="radio__placeholder text_body">Unique</span>
                    </div>
                    <div class="store__dropdown-filter-elem-right text_body" data-btn-text="Variable size">Variable shape & size</div>
                </div>
            </label>
        </div>
        <button class="store__mobile-filter__button btn">Apply</button>
    </div>
</div>

<?
if(!empty(get_field('content'))) {
    foreach(get_field('content') as $block) {
        get_template_part('includes/' . $block['acf_fc_layout'], null, $block);
    } 
}

get_footer();
?>