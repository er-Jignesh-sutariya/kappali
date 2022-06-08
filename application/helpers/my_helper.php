<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('my_crypt'))
{
    function my_crypt($string, $action = 'e' )
    {
        $secret_key = strtolower(str_replace(" ", '_', APP_NAME)).'_key';
	    $secret_iv = strtolower(str_replace(" ", '_', APP_NAME)).'_iv';

	    $output = false;
	    $encrypt_method = "AES-256-CBC";
	    $key = hash( 'sha256', $secret_key );
	    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

	    if( $action == 'e' ) {
	        $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
	    }
	    else if( $action == 'd' ){
	        $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );
	    }

	    return $output;
    }   
}

if ( ! function_exists('re'))
{
    function re($array='')
    {
        echo "<pre>";
        print_r($array);
        exit;
    }
}

if ( ! function_exists('e_id'))
{
    function e_id($id)
    {
        return $id * 44545;
    }
}

if ( ! function_exists('d_id'))
{
    function d_id($id)
    {
        return $id / 44545;
    }
}

if ( ! function_exists('admin'))
{
    function admin($url='')
    {
        return ADMIN.'/'.$url;
    }
}

if ( ! function_exists('b_asset'))
{
    function b_asset($url='')
    {
        return base_url('assets/back/'.$url);
    }
}

if ( ! function_exists('flashMsg'))
{
    function flashMsg($success, $succmsg, $failmsg, $redirect)
    {
        $CI =& get_instance();
        
        if ($success)
            $CI->session->set_flashdata(['title' => 'Success | ','notify' => 'success', 'message' => $succmsg]);
        else
            $CI->session->set_flashdata(['title' => 'Error ! ', 'notify' => 'danger', 'message' => $failmsg]);
        
        return redirect($redirect);
    }
}

if ( ! function_exists('send_sms'))
{
    function send_sms($mobile, $sms, $template)
    {
        if ($_SERVER['HTTP_HOST'] != 'localhost' && ENVIRONMENT === 'production') 
        { 
            $url = "APIKey=gK66xZ4cokWuhIB5Dz9WaA&senderid=KPPALI&channel=2&DCS=0&flashsms=0&number=".$mobile."&text=".urlencode($sms)."&route=31&EntityId=1301162529225568073&dlttemplateid=$template";
            $base_URL ='https://www.smsgatewayhub.com/api/mt/SendSMS?'.$url;
            
            $curl_handle = curl_init();
            curl_setopt($curl_handle,CURLOPT_URL,$base_URL);
            curl_setopt($curl_handle,CURLOPT_CONNECTTIMEOUT,2);
            curl_setopt($curl_handle,CURLOPT_RETURNTRANSFER,1);
            $result = curl_exec($curl_handle);
            curl_close($curl_handle);
            
            return $result;
        }
    }
}