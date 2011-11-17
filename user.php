<?php

include 'stripe/Stripe.php';
include 'constants.php';

Stripe::setApiKey(STRIPE_API_KEY);

class User {

  private $stripeToken;
  private $id;
  private $name;
  private $email;
  private $password;
  private $isRecurring;
  private $stripeCustomer;
  private $stripeCharge;

  function __construct($_name, $_email, $_password, $_stripeToken, $_isRecurring) {
    $this->email = $_email;
    $this->isRecurring = $_isRecurring;
    $this->name = $_name;
    $this->password = $_password;
    $this->stripeToken = $_stripeToken;
  }

  function store() {
    // TODO: implement this.
  }

  /**
   * charge()
   * Delegates to any of the helper functions below. Does not
   * handle exceptions. Up to caller.
   */
  function charge() {
    if ($this->isRecurring == True) {
        $this->charge_once();
    }
    else {
      $this->create_customer();
      $this->subscribe_customer();
    }
    return true;
  }

  /**
   * One-off charges.
   */
  private function charge_once() {
      $this->stripeCharge = Stripe_Charge::create(array("amount" => 1000,
                                                         "currency" => "usd",
                                                         "card" => $this->stripeToken));
  }

  /**
   * Subscription billing.
   */
  private function create_customer() {
      $this->stripeCustomer = Stripe_Customer::create(array("description" => $email,
                                                             "card" => $this->stripeToken));
  }

  private function subscribe_customer() {
    $this->stripeCustomer->updateSubscription(array("prorate" => true,
                                                    "plan" => "basic"));
  }
}

?>