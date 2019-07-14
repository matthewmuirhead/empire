<?php
  $start_date = new DateTime($item['start_time']);
  $end_date = new DateTime($item['end_time']);

  $timediff = $start_date->diff($end_date);
  $totalTime = $timediff->format('%H') * 60 + $timediff->format('%I'); // Hours * 60 + Minutes
  $totalTime = $totalTime / 60;

  $itemTotal = $totalTime*$productDetails['price'] * $item['duration'];
?>

<!-- Service -->
<div class="">
  <div class="">
    <h3><?=$item['name']?></h3>
    <p>Week Run Length: <?=$item['duration']?></p>
    <p>Day: <?=$item['day']?></p>
    <p>Time: <?=$start_date->format('H:i')?> - <?=$end_date->format('H:i')?></p>
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
