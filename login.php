<?php
  include 'layout.php';
  include('user.php');

  session_start();

  $login = False;
  $error = False;
  if ($_POST) {
    try {
      User::authenticate($_POST["username"], $_POST["password"]);
      header('Location: index.php');
    }
    catch (Exception $e) {
      $error = $e->getMessage();
    }
  }

  $header = get_header('Sign in');
  echo $header;
?>


<?php
  publishSuccessOrError($success, $error);
?>
      <div class="content">
        <div class="page-header">
          <h1>Login</h1>
        </div>
        <div class="row">
          <div class="span10">
              <form accept-charset="UTF-8" action="login.php" class="form-stacked" id="login-form" method="post">
                  <div style="margin:0;padding:0;display:inline"></div>
                  <div class='clearfix'>
                      <label for="user_name">Email *</label>
                      <div class='input'>
                          <input class="field" id="user-email" name="username" size="30" type="text" />
                      </div>
                  </div>
                  <div class='clearfix'>
                      <label for="user_email">Password *</label>
                      <div class='input'>
                          <input class="field" id="user-password" type="password" name="password" size="30" type="text" />
                      </div>
                  </div>
                  <div class='actions'>
                      <input class="btn primary" id="payment-submit" name="commit" type="submit" value="Register" />
                  </div>

              </form>
          </div>
          <div class="span4">
            <p>Not a member? <a href="register.php">Register</a> now!</p>
          </div>
        </div>
      </div>

<?php
  $footer = get_footer();
  echo $footer;
?>