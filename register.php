<?php
  require_once('lib/inc/layout.inc.php');
  require_once('lib/db.php');
  require_once('lib/user.php');

  session_start();

  if ($_SESSION["authenticated"])
    header('Location: index.php');

  $header = get_header('Register');
  echo $header;

  $paymentIsSuccessful = False;
  $error = False;

  if ($_POST) {

    /* Is this a recurring billing? */
    $isRecurring = 0;
    if (isset($_POST['is-recurring']))
      $isRecurring = 1;

    /* Instantiate a User object, store the user in the DB, and charge the card. */
    $user = new User($_POST['name'], $_POST['email'], $_POST['password'], $_POST['stripeToken'], $isRecurring);
    try {
      $user->store();
      $user->charge();
      $paymentIsSuccessful = True;
    }
    catch (Exception $e) {
      $error = "Error: ".$e->getMessage();
    }
  }

    publishSuccessOrError($paymentIsSuccessful, $error);
?>

      <div class="content">
        <div class="page-header">
          <h1>Register <small>Monospace costs only $10</small></h1>
        </div>
        <div class="row">
          <div class="span10">
              <form accept-charset="UTF-8" action="register.php" class="form-stacked" id="payment-form" method="post">
                  <div style="margin:0;padding:0;display:inline"></div>
                  <div class='clearfix'>
                      <label for="user_name">Name *</label>
                      <div class='input'>
                          <input class="field" id="user-name" name="name" size="30" type="text" />
                      </div>
                  </div>
                  <div class='clearfix'>
                      <label for="user_email">Email *</label>
                      <div class='input'>
                          <input class="field" id="user-email" name="email" size="30" type="text" />
                      </div>
                  </div>
                  <div class='clearfix'>
                      <label for="user_password">Password *</label>
                      <div class='input'>
                          <input class="field" id="user-password" name="password" size="30" type="password" />
                      </div>
                  </div>
                  <div class='clearfix'>
                      <label for="user_password_confirmation">Password confirmation *</label>
                      <div class='input'>
                          <input class="field" id="user-password-confirmation" name="password_confirmation" size="30" type="password" />
                      </div>
                  </div>
                  <noscript>
                      <p>
                          This form requires Javascript to use
                      </p>
                  </noscript>

                  <div id='credit-card' style='display:block'>
                      <!-- these fields are disabled before submission and are never transmitted back to rails -->
                      <div class='clearfix'>
                          <label for="number">Credit card number *</label>
                          <div class='input'>
                              <input class="field" id="number" name="credit_card_number" type="text" />
                          </div>
                      </div>
                      <div class='clearfix'>
                          <label for="cvv">Security code (CVV) *</label>
                          <div class='input'>
                              <input class="small" id="cvv" name="cvv" type="text" />
                          </div>
                      </div>
                      <div class='clearfix'>
                          <label for="expiry_date">Expiry date *</label>
                          <div class='input'>
                              <select class="small" id="expiry-month" name="expiry-month">
<?php

  for ($i = 1; $i <= 10; $i++) {
    echo "\t\t\t\t  <option value=\"$i\">$i</option>\n";
  }
?>
                                  <option selected="selected" value="11">11</option>
                                  <option value="12">12</option>
                              </select>
                              <select class="small" id="expiry-year" name="expiry_year">
                                  <option selected="selected" value="2011">2011</option>
<?php

  for ($i = 2012; $i <= 2036; $i++) {
    echo "\t\t\t\t  <option value=\"$i\">$i</option>\n";
  }
?>
                              </select>

                          </div>
                          <!-- empty -->
                      </div>
                      <div class='clearfix'>
                        <label for='is-recurring'>Auto-recharge?</label>
                        <div class='input'>
                          <input type='checkbox' name='is-recurring' id='is-recurring' value='is-recurring' />
                        </div>
                      </div>
                      <span class='help-block'>
                          Your credit card details will be sent directly to our payment processor
                      </span>
                  </div>
                  <div class='actions'>
                      <input class="btn primary" id="payment-submit" name="commit" type="submit" value="Register" />
                  </div>
              </form>

          </div>
          <div class="span4">
            <p>Monospace costs $10 a month. If you check the "Auto-recharge?" box, you'll automatically be billed every month until you choose to cancel the subscription.</p>
            <p>This is a test form, and will not charge your card. To test, feel free to enter 4242424242424242 (a <a href="http://en.wikipedia.org/wiki/Luhn_algorithm">valid</a> credit number).</p>
          </div>
        </div>
      </div>

<?php
  $footer = get_footer();
  echo $footer;
?>