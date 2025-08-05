<?
function wpCreateLead($data) {

	$request_post_data = array(
		'post_title'    => $data['email'],
		'post_status'   => 'publish',
		'post_type'     => 'lead',
		'meta_input' => [
			'json_lead' => json_encode($data),
		]
	);
	 
	// добавляем пост и получаем его ID 
	$request_post_id = wp_insert_post( $request_post_data );

	if( is_wp_error( $request_post_id ) ){
		echo $request_post_id->get_error_message();
	}

    $my_posts = get_posts( array(
        'exclude'     => array($request_post_id),
        'meta_query' => [
            [
                'key' => 'json_lead',
                'value' => stripcslashes(json_encode($data))
            ],
        ],
        'post_type'   => 'lead',
    ));

    
    $now = new DateTime();
    $minDifference = 999999;
    foreach($my_posts as $post) {
        $dateTime = new DateTime($post->post_modified_gmt);
        $currDifference = $now->getTimestamp() - $dateTime->getTimestamp();
        if($currDifference < $minDifference) {
            $minDifference = $currDifference;
        }
        
    }

    print_r($minDifference);

    return !($minDifference >= 60);
}
?>