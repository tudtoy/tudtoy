<?
get_header();



debug('');
debug('');
debug('');


$my_posts = get_posts( array(
    'exclude'     => array($request_post_id),
    'meta_query' => [
		[
			'key' => 'json_lead',
			'value' => '{"name":"Test","phone":"999-999-9999","full_phone":"+19999999999","preferred_messenger":"Telegram","messanger":"","email":"Ttest@mail.ru","message":"Test","utm_source":"yandex","utm_medium":"cpc","utm_campaign":"119656772","utm_content":"16961569394","utm_term":"---autotargeting","yclid":"15479169256389869567","link":"https://tudtoy.com/contacts/?sgsg=324","title":"New lead from tudtoy.com"}'
		],
	],
    'post_type'   => 'lead',
));


foreach($my_posts as $post) {
    print_r($post->ID);
    debug(get_field('json_lead', $post->ID));
}



?>
<?
get_footer();
?>