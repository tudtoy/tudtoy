<?
function amoCreateLead($action, $leadData) {
    // Основные данные сделки
    $leadName = 'Заказ с tudtoy.com';
    $price = !empty($leadData['total_price']) ? (float)$leadData['total_price'] : 0;
    
    // Контактная информация
    $contactName = '';
    $phone = !empty($leadData['full_phone']) ? $leadData['full_phone'] : '';
    $email = !empty($leadData['email']) ? $leadData['email'] : '';
    $address = !empty($leadData['address']) ? $leadData['address'] : '';

    if (!empty($leadData['full_name'])) {
        $contactName = $leadData['full_name'];
    } elseif (!empty($leadData['name'])) {
        $contactName = $leadData['name'];
    }
    
    // Формируем полный комментарий
    $commentText = "Детали заказа:\n\n";
    
    // Добавляем только заполненные поля
    $fieldsToAdd = [
        'order_id' => "Номер заказа: ",
        'name' => "Клиент: ",
        'full_name' => "Клиент: ",
        'phone' => "Телефон: ",
        'full_phone' => "Телефон: ",
        'email' => "Email: ",
        'address' => "Адрес: ",
        'postcode' => "Индекс: ",
        'country' => "Страна: ",
        'status' => "Статус: ",
        'link_to_order' => "Ссылка: "
    ];
    
    foreach ($fieldsToAdd as $field => $label) {
        if (!empty($leadData[$field])) {
            $commentText .= $label . $leadData[$field] . "\n";
        }
    }
    
    $commentText .= "Сумма: " . $price . " USD\n";
    
    // Добавляем комментарий клиента (проверяем оба возможных поля)
    $clientComment = '';
    if (!empty($leadData['comment'])) {
        $clientComment = $leadData['comment'];
    } elseif (!empty($leadData['message'])) {
        $clientComment = $leadData['message'];
    }
    
    if (!empty($clientComment)) {
        $commentText .= "\nКомментарий клиента:\n" . $clientComment . "\n";
    }
    
    // Добавляем товары, если они есть
    if (!empty($leadData['products']) && is_array($leadData['products'])) {
        $commentText .= "\nТовары:\n";
        foreach ($leadData['products'] as $product) {
            $commentText .= "- " . $product['item_name'] . " (" . $product['quantity'] . " шт. × " . $product['price'] . " USD)\n";
        }
    }

    $pipeline_id = 8639482;
    $status_IDs = [
        'leed' => ['status_id' => 70050010],
        'order' => ['status_id' => 70050170]
    ];

    $data = [
        [
            "name" => $leadName,
            "price" => $price,
            "status_id" => (int) $status_IDs[$action]['status_id'],
            "pipeline_id" => (int) $pipeline_id,
            "tags_to_add" => [
                [
                    "name" => "tudtoy.com"
                ],
                [
                    "name" => "ENG"
                ]
            ],
            "_embedded" => [
                "contacts" => [
                    [
                        "first_name" => $contactName ?: 'Клиент',
                        "last_name" => "",
                        "custom_fields_values" => [
                            [
                                "field_code" => "PHONE",
                                "values" => [
                                    [
                                        "enum_code" => "WORK",
                                        "value" => $phone
                                    ]
                                ]
                            ],
                            [
                                "field_code" => "EMAIL",
                                "values" => [
                                    [
                                        "enum_code" => "WORK",
                                        "value" => $email
                                    ]
                                ]
                            ],
                            [
                                "field_id" => 709841,
                                "values" => [
                                    [
                                        "value" => $address
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ]
    ];

    // Отдельный запрос для создания заметки
    $noteData = [
        "note_type" => "common",
        "params" => [
            "text" => $commentText
        ]
    ];

    $url_path = "/api/v4/leads/complex";
    $method = "POST";
    
    $request_response = amoSendRequest($url_path, $method, $data);
    
    // Если сделка создана успешно, добавляем заметку
    if (!empty($request_response) && strpos($request_response, 'Error') === false) {
        // Парсим ID созданной сделки
        preg_match_all('/\d+/', $request_response, $matches);
        $leadId = !empty($matches[0]) ? $matches[0][0] : null;
        
        if ($leadId) {
            $noteUrl = "/api/v4/leads/$leadId/notes";
            $noteResponse = amoSendRequest($noteUrl, "POST", [$noteData]);
            file_put_contents(ABSPATH . 'note_debug.txt', print_r($noteResponse, true));
        }
    }
    
    file_put_contents(ABSPATH . 'data_debug.txt', print_r($request_response, true));
    
    return $request_response;
}

function amoSendRequest($url_path, $method, $data_request = []) {
    static $subdomain, $access_token;
    
    if ($subdomain === null) {
        require_once 'access.php';
        
        $subdomain = $subdomain;
        $access_token = $access_token;
    }

    $url = "https://$subdomain.amocrm.ru" . $url_path;

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_COOKIEFILE, 'amo/cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEJAR, 'amo/cookie.txt');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 120);
    curl_setopt($curl, CURLOPT_TIMEOUT, 120);
    curl_setopt($curl, CURLOPT_MAXREDIRS, 10);

    if ($method == "POST") {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data_request));
    }
    
    $out = curl_exec($curl);
    $code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
    $code = (int) $code;
    $errors = [
        301 => 'Moved permanently.',
        400 => 'Wrong structure of the array of transmitted data, or invalid identifiers of custom fields.',
        401 => 'Not Authorized. There is no account information on the server. You need to make a request to another server on the transmitted IP.',
        403 => 'The account is blocked, for repeatedly exceeding the number of requests per second.',
        404 => 'Not found.',
        500 => 'Internal server error.',
        502 => 'Bad gateway.',
        503 => 'Service unavailable.'
    ];

    if ($code < 200 || $code > 204) {
        file_put_contents(__DIR__ . '/log.txt', $code . 'Error: ' . $out . PHP_EOL . 'URL: ' . $url . PHP_EOL, FILE_APPEND);

        print_r($out);
        echo "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error');
    }
    
    $Response = json_decode($out, true);

    if ($method == "POST") {
        file_put_contents(__DIR__ . '/log.txt', 'Success: ' . $Response . PHP_EOL, FILE_APPEND);

        $output = 'ID добавленных элементов списков:' . PHP_EOL;
        foreach ($Response as $v)
            if (is_array($v))
                $output .= $v['id'] . PHP_EOL;
        
        return $output;
    }
    
    return $Response;
}
?>