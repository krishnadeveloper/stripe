<?php
require('init.php');
putenv("STRIPE_SECRET_KEY=YOUR_STRIPE_SECRET_KEY"); // Put your stripe secret key
putenv("STRIPE_CLIENT_ID=YOUR_STRIPE_PUBLISH_TOKEN"); // Put your stripe publish token

\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
\Stripe\Stripe::setClientId(getenv('STRIPE_CLIENT_ID'));



\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
$token = \Stripe\Token::create(array(
  "card" => array(
    "number" => "4242424242424242",
    "exp_month" => 1,
    "exp_year" => 2019,
    "cvc" => "314"
  )
));

$customer = \Stripe\Customer::create(array(
      'email' => 'test@test'.rand().'.com',
      'source'  => $token->id
  ));
  
$charge = \Stripe\Charge::create(array(
      'customer' => $customer->id,
      'amount'   => 50,
      'currency' => 'gbp' // Change currency according to you
  ));

/*\Stripe\Stripe::setApiKey(getenv('STRIPE_SECRET_KEY'));
$charge = \Stripe\Charge::create(array(
  "amount" => 1,
  "currency" => "gbp",
  "customer" => "cus_AFGbOSiITuJVDs",
  "source" => $token->id,
));*/

print_r($charge);

?>