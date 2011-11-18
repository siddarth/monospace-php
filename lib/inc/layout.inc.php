<?php

/**
 * Returns a navigation bar using the routes defined above.
 * Deals correctly with active tab.
 */
function getNavBar($route) {
  $nav = "<ul class=\"nav\">\n";
  $routes = array();
  if (!$_SESSION["authenticated"])
    $routes = array("Home" => "index.php", "Register" => "register.php", "About" => "about.php", "Sign in" => "login.php");
  else
    $routes = array("Home" => "index.php", "About" => "about.php", "Sign out" => "logout.php");
  foreach ($routes as $r => $href) {
    if ($route == $r)
      $nav .= "\t\t<li class=\"active\"><a href=\"$href\">$r</a></li>\n";
    else
      $nav .= "\t\t<li><a href=\"$href\">$r</a></li>\n";
  }
  return $nav;
}

function publishSuccessOrError($isSuccess, $error) {
  if ($isSuccess == True) {
    echo '<div id="success" class="alert-message success">Payment successful. Log in above.</div>';
    echo '<div id="error" style="display:none;" class="alert-message error"></div>';
  }
  elseif ($error != False) {
    echo "<div id=\"error\" class=\"alert-message error\">$error</div>";
    echo '<div id="success" style="display:none;" class="alert-message success"></div>';
  }
  else {
    echo '<div id="error" style="display:none;" class="alert-message error"></div>';
    echo '<div id="success" style="display:none;" class="alert-message success"></div>';
  }
}
/**
 * Gets header for given route.
 */
function get_header($route)
{
  session_start();
  $nav = getNavBar($route);
  $header = <<<EOF
  <!DOCTYPE html>
  <html lang="en">
    <head>
      <meta charset="utf-8">
      <title>Monospace</title>
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

      <!-- Le fav and touch icons -->
      <link rel="shortcut icon" href="images/favicon.ico">
      <link rel="apple-touch-icon" href="images/apple-touch-icon.png">
      <link rel="apple-touch-icon" sizes="72x72" href="images/apple-touch-icon-72x72.png">
      <link rel="apple-touch-icon" sizes="114x114" href="images/apple-touch-icon-114x114.png">
    </head>

    <body>

      <div class="topbar">
        <div class="fill">
          <div class="container">
            <a class="brand" href="index.php">Monospace</a>
            $nav
            </div>
        </div>
      </div>

      <div class="container">
EOF;
  return $header;
}

/**
 * Returns footer.
 */
function get_footer() {
  $footer = <<<EOS
        <footer>
          <p>Built for <a href="http://stripe.com">Stripe</a> by <a href="http://siddarthc.com">Siddarth Chandrasekaran</a></p>
        </footer>

      </div> <!-- /container -->

    </body>
  </html>
EOS;
  return $footer;
}

?>