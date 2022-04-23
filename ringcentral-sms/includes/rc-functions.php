<?php
/**
 * Copyright (C) 2022 Paladin Business Solutions
 *
 */

/* ================== */
/* Get RingCental SDK */
/* ================== */
function rc_sdk($rc_handshake = "") {
    // Include Libraries
    require('vendor/autoload.php');
    
    // get control data
    global $wpdb;
    
    if ($rc_handshake == "") {
        $result_rc = $wpdb->get_row( $wpdb->prepare("SELECT * FROM `ringcentral_control`
            WHERE `ringcentral_control_id` = %d", 1) );
        $client_id      = $result_rc->client_id ;
        $client_secret  = $result_rc->client_secret ;
        $rc_user_name   = $result_rc->ringcentral_user_name ;
        $rc_extension   = $result_rc->ringcentral_extension ;
        $rc_password    = rc_decrypt($result_rc->ringcentral_password);    
    } else {
        $client_id      = $rc_handshake["client_id"] ;
        $client_secret  = $rc_handshake["client_secret"] ;
        $rc_user_name   = $rc_handshake["user_name"] ;
        $rc_extension   = $rc_handshake["extension"] ;
        $rc_password    = $rc_handshake["password"];
    }
    
    $sdk = new RingCentral\SDK\SDK($client_id, $client_secret, RingCentral\SDK\SDK::SERVER_SANDBOX);
   
    // attempt to Login via API
    try {
        $sdk->platform()->login($rc_user_name, $rc_extension, $rc_password);        
    } catch (\RingCentral\SDK\Http\ApiException $e) {        
        echo "<br/><br/>SDK Connection Error trace: <br/>" . $e ;
    }
    return $sdk ;    
}

/* ============================= */
/* send out welcome SMS function */
/* ============================= */
function rc_send_sms($to, $message) {
    
    $from = rc_get_from_phone();
    
    $sdk = rc_sdk("") ;
    try {
        // echo "in try...";
        $apiResponse = $sdk->platform()->post('/account/~/extension/~/sms',
            array('from' => array('phoneNumber' => $from),
                'to'   => array( array('phoneNumber' => $to) ),
                'text' => $message ) );
    } catch (\RingCentral\SDK\Http\ApiException $e) {              
        echo "<br/><br/>Sending SMSM Error trace: <br/>" . $e ;       
    }
} // end send_welcome_mobile function

/* ======================================== */
/* get from phone number from control table */
/* it is stored in the user_name field      */
/* ======================================== */
function rc_get_from_phone() {
    global $wpdb;
    $result_rc = $wpdb->get_row( $wpdb->prepare("SELECT `ringcentral_user_name`
            FROM `ringcentral_control` WHERE `ringcentral_control_id` = %d", 1 )
        );
    return $result_rc->ringcentral_user_name ;
}

/* ============================== */
/* Encrypt Password to Obfusicate */
/* ============================== */
function rc_encrypt($plaintext) {
	if (function_exists('openssl_cipher_iv_length')) { 
		$key = $_SERVER['SERVER_NAME'].$_SERVER['SERVER_ADDR'].$_SERVER['SERVER_SOFTWARE'];
		$cipher="AES-128-CBC";
		$ivlen = openssl_cipher_iv_length($cipher);
		$iv = substr($c, 0, $ivlen);
		return base64_encode(openssl_encrypt($plaintext, $cipher, $key));
	}
	return $plaintext;
}

/* ============================== */
/* Decrypt Password to Obfusicate */
/* ============================== */
function rc_decrypt($ciphertext) {
	if (function_exists('openssl_cipher_iv_length')) {
		$key = $_SERVER['SERVER_NAME'].$_SERVER['SERVER_ADDR'].$_SERVER['SERVER_SOFTWARE'];
		$cipher="AES-128-CBC";
		return openssl_decrypt(base64_decode($ciphertext), $cipher, $key);
	} else {
		return $ciphertext;
	}
}

/* ============================== */
/* Build help icon and title text */
/* ============================== */
function rc_build_help($field) {
    global $wpdb;
    $image_source = RINGCENTRAL_PLUGINURL . 'images/question_mark.png' ;
    
    $result_rc_help = $wpdb->get_row( $wpdb->prepare("SELECT ringcentral_help_help AS help_text
            FROM `ringcentral_help` WHERE `ringcentral_help_field` = %s", $field) );

    $out_string = "<img src='$image_source' title='" . esc_attr($result_rc_help->help_text) . "' />" ;
    return $out_string ;
}
?>