<div class="banner-area">
  <div class="title-img">
    <div class="title-info">
      <h1 style="font-size: 6em; font-weight:bold"><?=$templateVars[0]?></h1>
      <hr style="margin-bottom: 20px;" width="100px" noshade color="white"></hr>
      <p style="font-size: 1.5em;"><?=$templateVars[1]?></p>
    </div>
  </div>
</div>

<?php
$count = 0;
foreach ($templateVars[2] as $product) {
  if ($count%3==0 && $count!=0) { // End row and start new
    ?>
    </div>
    <div class="card-row" style="background-color: rgb(240,240,240); padding-top:5px; padding-bottom:1.7em">
    <?php
    require 'card.html.php';
  } elseif ($count%3!=0) { // Add card to row
    require 'card.html.php';
  } else { // Create initial card row
    ?>
    <div class="card-row" style="background-color: rgb(240,240,240); padding-top:5px; padding-bottom:1.7em">
    <?php
    require 'card.html.php';
  }
  $count++;
}
if ($count > 0) { // Close off last row
  ?>
  </div>
  <?php
}
?>
