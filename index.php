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
          <a class="brand" href="#">Monospace PHP</a>
          <ul class="nav">
            <li class="active"><a href="index.html">Home</a></li>
            <li><a href="register.html">Register</a></li>
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

      <div class="content">
        <div class="page-header">
          <h1>Monospace <small>A social network for developers</small></h1>
        </div>
        <div class="row">
          <div class="span10">
            <?php
              if ($_SESSION["authenticated"] == true) {
            ?>
            <p>Welcome to Monospace. Shouldn't you be writing code?</p>

            <?php
              }
              else {
            ?>
              <p>You don't appear to be logged in. Log in to Monospace above!</p>
            <?php
              }
            ?>
          </div>
          <div class="span4">
            <p>Monospace is a social network for developers. It's our sample PHP application, showing how to use Stripe to charge subscribers. Find out more about Monospace <a href="about.html">here</a>.</p>
          </div>
        </div>
      </div>

      <footer>
        <p>&copy; Company 2011</p>
      </footer>

    </div> <!-- /container -->

  </body>
</html>
