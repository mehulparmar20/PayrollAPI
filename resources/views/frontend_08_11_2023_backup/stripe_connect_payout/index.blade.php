<?php
require_once 'vendor/autoload.php';
$stripe = new \Stripe\StripeClient(
  $_ENV['STRIPE_SECRET_KEY']
);

// create connect accoount
// $account=$stripe->accounts->create([
//   'type' => 'express',
//   'country' => 'US',
//   'email' => 'bhagwati@veravalonline.com',
//   'capabilities' => [
//     'card_payments' => ['requested' => true],
//     'transfers' => ['requested' => true],
//   ],
// ]);
// print_r($account);exit;
$id="acct_1NexopPRXRZiex0e";
// $clintid="ca_N9FRgTA7s1rFDaExxDHVfo4aWInYLwUk";

// create_accountlink
$v=$stripe->accountLinks->create([
  'account' =>$id,
  'refresh_url' => 'https://b4m.veravalonline.com/b4m/reauth_stripe',
  'return_url' => 'https://b4m.veravalonline.com/b4m/return_stripe',
  'type' => 'account_onboarding',
]);

print_r($v);