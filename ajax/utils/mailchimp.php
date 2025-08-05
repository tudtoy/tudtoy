<?
function sendRequest($method, $path, $data) {
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://us21.api.mailchimp.com/3.0' . $path,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => json_encode($data),
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer b3b2f1bcfa7549d2e76ab3f67ceb0f5f-us21',
        ),
    ));

    $response = curl_exec($curl);

    curl_close($curl);

    return $response;
}

function sendMailInMailchimp($data, $tags = []) {
    if (count($tags) === 0) {
        $tags = [
            [
                'name' => 'Subscribers ENG AUTO',
                'status' => 'active'
            ]
        ];
    }

    // Add Email in List
    $email = $data['email'];
    $email = strtolower($email);

    $list_id = 'bd6b162412';
    $addToListPath = '/lists/' . $list_id . '/members/' . md5($email);

    $response = sendRequest('PUT', $addToListPath, [
        'email_address' => $email,
        'status_if_new' => 'subscribed'
    ]);

    // Add Tag to Email
    $addTagPath = '/lists/' . $list_id . '/members/' . md5($email) . '/tags/';
    $response = sendRequest('POST', $addTagPath, [
        'tags' => $tags
    ]);

    }
?>