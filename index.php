<?php
  require_once('lib/inc/layout.inc.php');
  $header = get_header('Home');
  echo $header;
?>

      <div class="content">
        <div class="page-header">
          <h1>Monospace <small>A social network for developers</small></h1>
        </div>
        <div class="row">
          <div class="span10">
            <?php
              if ($_SESSION["authenticated"]) {
            ?>
            <p>Welcome to Monospace, <? echo $_SESSION["user"]["name"] ?>. Shouldn't you be writing code?</p>

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

<?php
  $footer = get_footer();
  echo $footer;
?>
