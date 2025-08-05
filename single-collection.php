<?
get_header();

if(!empty(get_field('content'))) {
    foreach(get_field('content') as $block) {
        get_template_part('includes/' . $block['acf_fc_layout'], null, $block);
    } 
}

get_footer();
?>