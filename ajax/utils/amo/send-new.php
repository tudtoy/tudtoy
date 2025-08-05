<?
function amoCreateLead($action, $leadData) {
    $name = '';
    $email = '';
    $comment = '';
    $address = '';
    $target = 'Заявка с сайта tudtoy.com';
    $price = 0;

    $pipeline_id = 8639482;

    $status_IDs = [
        'leed' => [
            'status_id' => 70050010
        ],
        'order' => [
            'status_id' => 70050170
        ]
    ];

    if(!empty($leadData['name'])) {
        $name = $leadData['name'];
    }

    if(!empty($leadData['full_name'])) {
        $name = $leadData['full_name'];
    }

    if(!empty($leadData['full_phone'])) {
        $phone = $leadData['full_phone'];
    }

    if(!empty($leadData['email'])) {
        $email = $leadData['email'];
    }

    if(!empty($leadData['address'])) {
        $address = $leadData['address'];
    }

    if(!empty($leadData['comment'])) {
        $comment = $leadData['comment'];
    }

    $data = [
        [
            "name" => $leadData['title'],
            "pipeline_id" => (int) $pipeline_id,
            'status_id' => (int) $status_IDs[$action]['status_id'],
            "tags_to_add" => [
                [
                    "name" => "ENG"
                ]
            ],
            "_embedded" => [
                "contacts" => [
                    [
                        "first_name" => $name,
                        "custom_fields_values" => [
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
                                "field_code" => "PHONE",
                                "values" => [
                                    [
                                        "enum_code" => "WORK",
                                        "value" => $phone
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
                            ],
                        ]
                    ]
                ],
            ],
        ]
    ];

    $url_path = "/api/v4/leads/complex";
    $method = "POST";
    
    $request_response = amoSendRequest($url_path, $method, $data);
    
    return $request_response;
}

function amoSendRequest($url_path, $method, $data = []) {
    require_once 'access.php';
    
    $url = "https://$subdomain.amocrm.ru";

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $access_token,
    ];

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_USERAGENT, 'amoCRM-API-client/1.0');
    curl_setopt($curl, CURLOPT_URL, $url.$url_path);
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_COOKIEFILE, 'amo/cookie.txt');
    curl_setopt($curl, CURLOPT_COOKIEJAR, 'amo/cookie.txt');
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);

    if ($method == "POST") {
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
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
        print_r($out);
        echo "Error $code. " . (isset($errors[$code]) ? $errors[$code] : 'Undefined error');

        $f = fopen('log.txt', 'w');
        fwrite($f, $out);
        fclose($f);
    }
    
    $Response = json_decode($out, true);

    if ($method == "POST") {
        $output = 'ID добавленных элементов списков:' . PHP_EOL;
        foreach ($Response as $v)
            if (is_array($v))
                $output .= $v['id'] . PHP_EOL;

        $f = fopen('log.txt', 'w');
        fwrite($f, $output);
        fclose($f);
        
        return $output;
    }
    
    return $Response;
}
?>