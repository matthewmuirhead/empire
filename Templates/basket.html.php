<h1>Basket</h1>

<?php
  $total = 0;
  $orderDetails = [];
  foreach ($templateVars[0] as $item) {
    $productOrder = [];
    $productDetails = [];
    foreach ($templateVars[1] as $product) {
      if ($product['product_id'] == $item['product_id']) {
        $productDetails = $product;
      }
    }
    if ($item['type'] == 'Subscription') {
      require 'subscriptionsBasket.html.php';
      $productOrder = [
        'type' => $item['type'],
        'product_id' => $item['product_id'],
        'price' => $itemTotal,
        'start' => $item['start_day'],
        'end' => $item['end_day']
      ];
    } else if ($item['type'] == 'Service') {
      require 'servicesBasket.html.php';
      $dateStart = date('Y-m-d H:i:s', strtotime($item['start_time']));
      $dateEnd = date('Y-m-d H:i:s', strtotime($item['end_time']));
      $productOrder = [
        'type' => $item['type'],
        'product_id' => $item['product_id'],
        'price' => $itemTotal,
        'start_time' => $dateStart,
        'end_time' => $dateEnd,
        'day' => $item['day'],
        'duration' => $item['duration']
      ];
    } else if ($item['type'] == 'Good') {
      require 'goodsBasket.html.php';
      $productOrder = [
        'type' => $item['type'],
        'product_id' => $item['product_id'],
        'price' => $itemTotal,
        'quantity' => $item['quantity']
      ];
    }
    $total += $itemTotal;
    echo '<hr style="width:99%"/>';


    array_push($orderDetails, $productOrder);
  }
?>

<h3>Total: £<?=$total?></h3>
<form class="" action="/checkout" method="post">
  <input type="hidden" name="order" value="<?=base64_encode(serialize($orderDetails))?>">
  <input type="hidden" name="total" value="<?=$total?>">
  <input type="submit" name="submit" value="Go to Checkout">
</form>
