<?php
//http://mugurel.sumanariu.ro/php-2/php-how-to-calculate-number-of-work-days-between-2-dates/
$start = $item['start_day'];
$end = $item['end_day'];
$nr_work_days = getWorkingDays($start,$end);

function getWorkingDays($startDate, $endDate){
 $begin=strtotime($startDate);
 $end=strtotime($endDate);
 if($begin>$end){
  echo 'startdate is in the future! <br />';
  return 0;
 }else{
   $no_days=0;
   $weekends=0;
  while($begin<=$end){
    $no_days++; // no of days in the given interval
    $what_day=date('N',$begin);
     if($what_day>5) { // 6 and 7 are weekend days
          $weekends++;
     };
    $begin+=86400; // +1 day
  };
  $working_days=$no_days-$weekends;
  return $working_days;
 }
}

$itemTotal = $nr_work_days*$productDetails['price']
?>

<!-- Subs -->
<div class="">
  <div class="">
    <h3><?=$item['name']?></h3>
    <p>Start Day: <?=$start?></p>
    <p>End Day: <?=$end?></p>
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
