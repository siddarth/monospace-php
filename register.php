<?php

  include('user.php');
  $paymentIsSuccessful = False;
  $error = False;
  if ($_POST) {
    /**
     * TODO: Sanitiiiizeeeee.
     */
    $user = new User($_POST['name'], $_POST['email'], $_POST['password'], $_POST['stripeToken'], False);
    try {
      $user->charge();
      $paymentIsSuccessful = True;
    }
    catch (Exception $e) {
      $error = "Error: ".$e->getMessage().": token = ".$_POST['stripeToken'];
    }
  }

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Bootstrap, from Twitter</title>
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le styles -->
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">

    <!-- Le Javascript -->
    <script type="text/javascript" src="https://js.stripe.com/v1/"></script>
    <script src="js/jquery.min.js" type="text/javascript"></script>
    <script src="js/jquery_ujs.js" type="text/javascript"></script>
    <script src="js/application.js" type="text/javascript"></script>

  </head>

  <body>

    <div class="topbar">
      <div class="fill">
        <div class="container">
          <a class="brand" href="#">Monospace</a>
          <ul class="nav">
              <li><a href="index.html">Home</a></li>
              <li><a class="active" href="register.html">Register</a></li>
              <li><a href="about.html">About</a></li>
          </ul>
          <form action="" class="pull-right">
            <input class="input-small" type="text" placeholder="Username">
            <input class="input-small" type="password" placeholder="Password">
            <button class="btn" type="submit">Sign in</button>
          </form>
        </div>
      </div>
    </div>


    <div class="container">
<?php
    if ($paymentIsSuccessful == True)
        echo '<div id="success" class="alert-message success">Payment successful. Log in above.</div>';
    elseif ($error != False)
      echo "<div id=\"error\" class=\"alert-message error\">$error</div>";
    else {
      echo '<div id="error" style="display:none;" class="alert-message error"></div>';
      echo '<div id="success" style="display:none;" class="alert-message success"></div>';
    }
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
                                  <option value="1">1</option>
                                  <option value="2">2</option>
                                  <option value="3">3</option>
                                  <option value="4">4</option>
                                  <option value="5">5</option>
                                  <option value="6">6</option>
                                  <option value="7">7</option>
                                  <option value="8">8</option>
                                  <option value="9">9</option>
                                  <option value="10">10</option>
                                  <option selected="selected" value="11">11</option>
                                  <option value="12">12</option>
                              </select>
                              <select class="small" id="expiry-year" name="expiry_year">
                                  <option selected="selected" value="2011">2011</option>
                                  <option value="2012">2012</option>
                                  <option value="2013">2013</option>
                                  <option value="2014">2014</option>
                                  <option value="2015">2015</option>
                                  <option value="2016">2016</option>
                                  <option value="2017">2017</option>
                                  <option value="2018">2018</option>
                                  <option value="2019">2019</option>
                                  <option value="2020">2020</option>
                                  <option value="2021">2021</option>
                                  <option value="2022">2022</option>
                                  <option value="2023">2023</option>
                                  <option value="2024">2024</option>
                                  <option value="2025">2025</option>
                                  <option value="2026">2026</option>
                                  <option value="2027">2027</option>
                                  <option value="2028">2028</option>
                                  <option value="2029">2029</option>
                                  <option value="2030">2030</option>
                                  <option value="2031">2031</option>
                                  <option value="2032">2032</option>
                                  <option value="2033">2033</option>
                                  <option value="2034">2034</option>
                                  <option value="2035">2035</option>
                                  <option value="2036">2036</option>
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
            <p>This is a test form, and will not charge your card. To test, feel free to enter 4242424242424242 (a <a href="http://en.wikipedia.org/wiki/Luhn_algorithm">valid</a> credit number).</p>
            <p>Monospace costs $10 a month. If you check the "Auto-recharge?" box, you'll automatically be billed every month until you choose to cancel the subscription.</p>
          </div>
        </div>
      </div>

      <footer>
        <p>&copy; Company 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>