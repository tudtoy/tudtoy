<?

function check_identifier($code) {
    $result = [];
    
    $google_code = '1ebWiBRUK_uLKpAKeqFaj40bD8ABbp-KR6ljxj-3lp64';
    $gid = '379348508';
    $spreadsheet_url = "https://docs.google.com/spreadsheets/d/" . $google_code . "/export?gid=" . $gid . "&format=csv";
  
    if (($handle = fopen($spreadsheet_url, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
            $spreadsheet_data[$data[3]] = $data;
        }
        fclose($handle);
    }
    else {
        $result['success'] = false;
        $result['message'] = 'Table not loaded';
    }
        
  
    if (isset($spreadsheet_data[$code])) {
        $result = $spreadsheet_data[$code];
        $result['success'] = true;
    } else {
        $result['success'] = false;
        $result['message'] = 'TUD not found';
    }

    return $result;
}

function verify() {
    if(empty($_POST['code'])) {
        echo json_encode([
            'success' => false,
        ]);
        wp_die();
    }

    $code = $_POST['code'];
    $tudData = check_identifier($code);

    if(!$tudData['success']) {
        echo json_encode($tudData);
        wp_die();
    }

    $tudData = [
        'ID' => $tudData[0],
        'name' => $tudData[1],
        'number' => $tudData[2],
        'code' => $tudData[3],
        'timestamp' => $tudData[4],
        'success' => $tudData['success'],
        
    ];

    if($tudData['success']) {
        $tud = wc_get_product($tudData['ID']);
        $collection = get_field('collection', $tudData['ID']);
        
        $tudData['url'] = '/check/' . $collection->post_name . '/' . $tud->slug . '/?code=' . $tudData['code'];
    }

    echo json_encode($tudData);

    wp_die();
}

?>