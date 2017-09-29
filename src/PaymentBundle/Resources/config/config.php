<?php

namespace PaymentBundle\Resources\config;

require_once('vendor/autoload.php');

$stripe = array(
  "secret_key"      => "sk_test_sOYMH9QVjgTyYof1TCyOYWpb",
  "publishable_key" => "pk_test_7RFP43V6JWGyPLVJFZlzk7Z0"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>