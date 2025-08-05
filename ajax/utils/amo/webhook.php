<?php
/**
 * Register REST API route for AmoCRM webhook.
 */
add_action('rest_api_init', function() {
    register_rest_route('custom/v1', '/amo-webhook', [
        'methods'  => 'POST',
        'callback' => 'handle_amo_webhook',
        'permission_callback' => '__return_true',
    ]);
});

/**
 * Handle function for AmoCRM webhook.
 */
function handle_amo_webhook(WP_REST_Request $request) {
    $raw_data = $request->get_body();
    $data = parse_str($raw_data, $parsed_data);
    $data = $parsed_data;

    // Check if this is a "change of deal status" event
    if (isset($data['leads']['status'][0]['id'])) {
        $lead_id = $data['leads']['status'][0]['id'];
        $new_status_id = $data['leads']['status'][0]['status_id'];
        $tags_array = (array) $data['leads']['status'][0]['tags'];

        $lead_contact_id = (int) get_leed_account_id_from_amo($lead_id);
        $lead_lang_tag = get_leed_lang_tag_from_amo($tags_array);
        $lead_email = get_leed_email_from_amo($lead_contact_id);

        // Send data to Mailchimp
        if ($lead_email) {
            send_to_mailchimp_new_tag($lead_email, $lead_lang_tag, $new_status_id);
        }
    }

    file_put_contents(
        'webhook.json',
        json_encode([
            'timestamp'     => current_time('mysql'),
            'raw_data'      => $raw_data,
            'data'          => $data,
            'lead_email'    => $lead_email,
            'lead_tag'      => $lead_lang_tag,
            'headers'       => $request->get_headers()
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE)
    );

    return new WP_REST_Response(['success' => true], 200);
}

function get_leed_email_from_amo($contact_id) {
    $url = "/api/v4/contacts/" . $contact_id;
    $contact_data = amoSendRequest($url, "GET");

    $lead_email = $contact_data['custom_fields_values'][0]['values'][0]['value'];

    return $lead_email;
}

function get_leed_account_id_from_amo($lead_id) {
    $url = "/api/v4/leads/" . $lead_id . "?with=contacts";
    $lead_data = amoSendRequest($url, "GET");

    $contact_id = $lead_data['_embedded']['contacts'][0]['id'];

    return $contact_id;
}

function get_leed_lang_tag_from_amo($tags) {
    $keys = array_column($tags, 'name');
    $index = array_search('ENG', $keys);

    if (empty($index) || $index == false) {
        $index = array_search('RU', $keys);
    }
    
    $lead_tag = $keys[$index];

    return $lead_tag;
}

/**
 * Get lead email from AmoCRM.
 */
function send_to_mailchimp_new_tag($lead_email, $lead_lang_tag, $new_status_id) {
    $new_status_tag = "";

    switch ($new_status_id) {
        case '142':
            $new_status_tag = "New purchase";
            break;
        case '70050158':
            $new_status_tag = "Potentials";
            break;
        case '70050018':
            $new_status_tag = "Cold";
            break;
        case '143':
            $new_status_tag = "Cold";
            break;
    }

    $data = [
        "email" => $lead_email
    ];

    $tags = [];

    if ( !empty($new_status_tag) ) {
        $tags[] = [
            'name' => $new_status_tag,
            'status' => 'active'
        ];
    }

    if ( !empty($lead_lang_tag) ) {
        $tags[] = [
            'name' => $lead_lang_tag,
            'status' => 'active'
        ];
    }

    sendMailInMailchimp($data, $tags);
}