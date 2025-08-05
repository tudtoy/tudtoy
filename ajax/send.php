<?

require_once 'utils/telegram.php';
require_once 'utils/mailchimp.php';
require_once 'utils/wordpress.php';

function subscribe () {
    
    if(empty($_POST['email'])) {
        wp_die();
    }

    $ip = $_SERVER['REMOTE_ADDR'];

    if($ip == '91.84.113.124' || $ip == '91.84.112.178') {
        wp_die();
        return;
    }

    $duplicate = wpCreateLead([
        'email' => $_POST['email'],
    ]);

    if(!$duplicate) {
        sendTelegramMessage('subscribe', [
            'title' => 'New subscribe from tudtoy.com',
            'email' => $_POST['email'],
            'ip' => $ip
        ]);
    
        sendMailInMailchimp([
            'email' => $_POST['email'],
        ]);
    
        amoCreateLead('leed', [
            'title' => 'New subscribe from tudtoy.com',
            'email' => $_POST['email']
        ]);
    }

    wp_die();
}

function submit() {

    $ip = $_SERVER['REMOTE_ADDR'];

    if($ip == '91.84.113.124') {
        wp_die();
        return;
    }

    if(empty($_POST['data'])) {
		return;
	}

    parse_str($_POST['data'], $data);
    $data['title'] = 'New lead from tudtoy.com';

    $duplicate = wpCreateLead($data);
    if(!$duplicate) {
        sendTelegramMessage('leed', $data);
        sendMailInMailchimp($data);
        amoCreateLead('leed', $data);
    }
    

    wp_die();
}

?>