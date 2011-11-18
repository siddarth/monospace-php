<?php
  require_once('lib/inc/layout.inc.php');
  $header = get_header('About');
  echo $header;
?>

      <div class="content">
        <div class="page-header">
          <h1>About</h1>
        </div>
        <div class="row">
          <div class="span10">
            <p>Monospace is a social network for developers. It's a sample PHP application, showing how to use <a href="http://stripe.com/">Stripe</a> to charge subscribers.</p>

            <p>Monospace uses the Stripe Javascript bindings to validate a credit card, and the Stripe PHP bindings to create a customer and add the credit card to that customer. Customers can also update their credit card.<p>

            <p>You can play with a live version <a href="#">here</a>.</p>

            <h3>Installation steps</h3>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam non libero magna, non scelerisque ipsum. Donec sed velit nec nunc placerat mattis. Proin suscipit viverra orci, sollicitudin tristique felis bibendum at. Integer eleifend eros vitae leo scelerisque sed pulvinar felis convallis. Phasellus eleifend lacus eu lectus accumsan adipiscing. Phasellus interdum accumsan vehicula. Donec sed interdum elit. Aliquam erat volutpat. Quisque aliquet iaculis sagittis. Proin elementum sodales turpis, nec accumsan massa imperdiet vel. Aenean ut leo at mauris viverra blandit. Integer congue posuere sollicitudin. Mauris vestibulum sagittis adipiscing. Aenean vel sem non tortor pretium tincidunt a vel sapien. Aliquam dictum felis vel tortor accumsan imperdiet. Aliquam mi libero, malesuada a ultricies sit amet, imperdiet lacinia sem.</p>
          </div>
        </div>
      </div>

<?php
  $footer = get_footer();
  echo $footer;
?>