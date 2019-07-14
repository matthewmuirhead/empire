<?php
  $itemTotal = $item['quantity']*$productDetails['price'];
?>

<!-- Goods -->
<div class="">
  <div class="">
    <h3><?=$item['name']?></h3>
    <p>Quantity: <?=$item['quantity']?></p>
    <form class="" action="goods" method="post">
      <input type="hidden" name="product_id" value="<?=$product['product_id']?>">
      <input type="hidden" name="method" value="remove">
      <input type="submit" name="remove" value="Remove">
    </form>
  </div>
  <div class="">
    <p>Individual Cost: £<?=$productDetails['price']?></p>
    <p>Total Cost: £<?=$itemTotal?></p>
  </div>
</div>
