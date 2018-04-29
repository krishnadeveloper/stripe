<?php
require('stripe/init.php');
$email = "test@example.com";
$card = "4111111111111111";
$exp_month = "01"; // Month - Jan
$exp_year = "2018"; // Year
$cvv = "234";

// Test Mode
//putenv("STRIPE_SECRET_KEY=sk_test_your_test_key);
//putenv("STRIPE_CLIENT_ID=pk_test_your_test_key");

// Live mode
putenv("STRIPE_SECRET_KEY=sk_live_your_key");
putenv("STRIPE_CLIENT_ID=pk_live_your_key");

\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
\Stripe\Stripe::setClientId(getenv('STRIPE_CLIENT_ID'));
    
  $cusamount = ($amount*100);
	$message = "Unknown error";
	try{
		\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
		$token = \Stripe\Token::create(array(
		  "card" => array(
		    "number" => $card,
		    "exp_month" => $exp_month,
		    "exp_year" => $exp_year,
		    "cvc" => $cvv
		  ),
		  "client_ip"=>$_SERVER['REMOTE_ADDR']
		));

		$customer = \Stripe\Customer::create(array(
		      'email' => $email,
		      'source'  => $token->id
		));

		$charge = \Stripe\Charge::create(array(
		      'customer' => $customer->id,
		      'amount'   => $cusamount,
		      'currency' => 'gbp' // Change currency according to you
		));
		
		
		if(strlen($charge->id)>0 && $charge->captured==1){
			$message = "payment successfull";
		}


	}
	catch(exception $e)	{
		
		$message = $e->getMessage();
	}
		
?>
