<?php

// LETS SEE WHAT HAPPENS
require_once("vendor/autoload.php");
use Bigcommerce\Api\Client as Bigcommerce;
	Bigcommerce::configure(array(
	//	 'store_url' => 'https://api.bigcommerce.com/stores/squ9oe18we/v2/orders',
		'client_id'		=> '72d8j0kob7u7qnj2836pfscoyvgwdxt',
		'auth_token'	=> 'c1u6ulb646hbyesix8jocwlruez7jwc',
		'store_hash'	=> '7etiemt2ez'
	));
	Bigcommerce::verifyPeer(false);
	$config	= array(
		"pagination_limit" => 250
	);
/* CONFIG ENDS */
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP'))
		$ipaddress = getenv('HTTP_CLIENT_IP');
	else if(getenv('HTTP_X_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	else if(getenv('HTTP_X_FORWARDED'))
		$ipaddress = getenv('HTTP_X_FORWARDED');
	else if(getenv('HTTP_FORWARDED_FOR'))
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	else if(getenv('HTTP_FORWARDED'))
	    $ipaddress = getenv('HTTP_FORWARDED');
	else if(getenv('REMOTE_ADDR'))
		$ipaddress = getenv('REMOTE_ADDR');
	else
		$ipaddress = 'UNKNOWN';
 // get_client_ip
$product_id=103;
$data= array(
	'customer_id' =>0,
	'status_id'=>1,
	 'payment_method'=> 'cash',
	'ip_address'=> $ipaddress ,
	'products'=>array(
					'product'=>array(
							'product_id'=>(int)$product_id,
							'quantity'=>1
						)
				),
	'billing_address'=>array(
					"first_name"=>"ali",
					"last_name"=>"haider",	
					"company"=>	"",
					"street_1"=>"124 Avenue RD",
					"street_2"=>"",
					"city"=>"Houston",
					"state"=>"texas",
					"zip"=>"77841",
					"country"=>"United States",
					"country_iso2"=>"US",
					"phone"=>"281-330-8084",
					"email"=>"haider@bigcommerce.com"
				)
	);
Bigcommerce::failOnError();
try {
    $order = Bigcommerce::createOrder($data);
    print_r($order);
} catch(Bigcommerce\Api\Error $error) {
    echo $error->getCode();
    echo $error->getMessage();
}
?>