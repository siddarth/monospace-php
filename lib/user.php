<?php

require_once 'stripe/Stripe.php';
require_once 'inc/constants.inc.php';
require_once 'db.php';

Stripe::setApiKey(STRIPE_API_KEY);
Db::db_connect();

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

  static function authenticate($user, $passwd) {
    if (($user == "") || ($passwd == ""))
      throw new Exception("Enter both the username and password.");

    $query = sprintf("SELECT * FROM stripe WHERE email='%s' AND password='%s'",
                     mysql_real_escape_string($user),
                     mysql_real_escape_string($passwd));
    $result = mysql_query($query);
    if (!$result)
      throw new Exception("Error: ".mysql_error());
    if (mysql_num_rows($result) == 1) {
      $row = mysql_fetch_array($result);
      $_SESSION['user'] = $row;
      $_SESSION['authenticated'] = True;
    }
    else {
      throw new Exception("Invalid credentials");
    }
  }

  function store() {

    $query = sprintf("SELECT * FROM stripe WHERE email='%s'", mysql_real_escape_string($this->email));
    $result = mysql_query($query);
    if (!$result) {
      throw new Exception(mysql_error());
    }
    if (mysql_num_rows($result) != 0)
      throw new Exception("User with email ".$this->email." already exists.");

    $query = sprintf("INSERT INTO stripe (name, email, password, stripeToken, isRecurring) VALUES ('%s', '%s', '%s', '%s', %d)",
                     mysql_real_escape_string($this->name),
                     mysql_real_escape_string($this->email),
                     mysql_real_escape_string($this->password),
                     mysql_real_escape_string($this->stripeToken),
                     $this->isRecurring);
    mysql_query($query);

    return true;
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