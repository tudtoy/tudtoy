<?

// Перенос строки
function sep() {
    return '
';
}

function sendTelegramMessage($action, $data) {
    $chatIDs = [
        'subscribe' => [
            'chatID' => -1002215419392,
            'topikID' => 1371
        ],
        'leed' => [
            'chatID' => -1002215419392,
            'topikID' => 1372
        ],
        'order' => [
            'chatID' => -1002215419392,
            'topikID' => 1373
        ],
    ];

    $message = '<b>' . $data['title'] . '</b>' . sep() . sep();

    foreach($data as $key => $elem) {
        if($key == 'title') {
            continue;
        }
        if($key == 'products') {
            $message .= sep() . '<b>Products:</b>' . sep();
            
            foreach($elem as $product) {
                $message .= $product['item_name'] . ' x' . $product['quantity'] . ' - $' . $product['price'] . sep();
            }
            continue;
        }

        $message .= $key . ': ' . $elem . sep();
    }

    $token = "7825462052:AAFgXEw59OtudmMIx6ykeH5O4QTbVzF9iWk";
	$getQuery = array(
	    "chat_id" 	=> $chatIDs[$action]['chatID'],
        "message_thread_id" => $chatIDs[$action]['topikID'],
	    "text"  	=> $message,
	    "parse_mode" => "html"
	);
	$ch = curl_init("https://api.telegram.org/bot". $token ."/sendMessage?" . http_build_query($getQuery));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HEADER, false);
	$resultQuery = curl_exec($ch);
	curl_close($ch);
}

?>