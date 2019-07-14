<div class="card">
  <div class="card-title">
    <h2><?=$product['name']?></h2>
  </div>
  <div class="card-img-container">
    <img src="/images/banners/img2.jpg" alt="" class="card-img">
  </div>
  <div class="card-desc">
    <p>
      £<?=$product['price']?>
    </p>
    <?php
    if ($product['availability'] > 0) {
      ?>
      <p>In Stock</p>
      <?php
    } else {
      ?>
      <p>Not in Stock</p>
      <?php
    }
    ?>
    <p>
      <?=$product['description']?>
    </p>
    <?php
    if ($templateVars[0] == 'Subscription') {
      require 'goods.html.php';
    }
    ?>
  </div>
  <?php
  $found = false;
  foreach ($_SESSION['basket'] as $item) {
    if ($item['product_id'] == $product['product_id']) {
      $found = true;
    }
  }

  if ($found == true) {
    ?>
    <form class="" action="" method="post">
      <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
      <input type="hidden" name="method" value="remove">
      <?php
      if ($templateVars[0] == 'Subscriptions') {
        require 'subscriptions.html.php';
      } else if ($templateVars[0] == 'Services') {
        require 'services.html.php';
      } else if ($templateVars[0] == 'Goods') {
        require 'goods.html.php';
      }
      ?>
      <input type="submit" name="" value="In Basket" class="card-basket">
    </form>
    <?php
  } else {
    ?>
    <form class="" action="" method="post">
      <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
      <input type="hidden" name="method" value="add">
      <input type="hidden" name="name" value="<?=$product['name']?>">
      <input type="hidden" name="type" value="<?=$product['type']?>">
      <?php
      if ($templateVars[0] == 'Subscriptions') {
        require 'subscriptions.html.php';
      } else if ($templateVars[0] == 'Services') {
        require 'services.html.php';
      } else if ($templateVars[0] == 'Goods') {
        require 'goods.html.php';
      }
      ?>
      <input type="submit" name="" value="Add to Basket" class="card-basket">
    </form>
    <?php
  }
  ?>

</div>
