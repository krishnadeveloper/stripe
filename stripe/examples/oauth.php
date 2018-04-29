<?php

require('../init.php');
putenv("STRIPE_SECRET_KEY=sk_test_7er4T0qVU6ndp8mtfz19fgem");
putenv("STRIPE_CLIENT_ID=pk_test_6J4I4OxqvwV1oYB2BUbL2Xpd");

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
      'currency' => 'gbp'
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