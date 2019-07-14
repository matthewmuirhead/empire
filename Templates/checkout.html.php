<h1>Checkout</h1>

<h3>Total Payable: £<?=$templateVars[0]?></h3>

<!-- Card Payment details *inactive* -->
<form class="" action="/payment" method="post">
  <label for="">Card Holder</label>
  <input type="text" name="" value="">
  <label for="">Card Number</label>
  <input type="text" name="" value="">
  <label for="">Expiry</label>
  <select class="" name="">
    <?php
      for ($i=1; $i < 13; $i++) {
        if ($i < 10) {
          ?>
          <option value="<?=$i?>">0<?=$i?></option>
          <?php
        } else {
          ?>
          <option value="<?=$i?>"><?=$i?></option>
          <?php
        }
      }
    ?>
  </select>
  <select class="" name="">
    <?php
      for ($i=2019; $i < 2029; $i++) {
        ?>
        <option value="<?=$i?>"><?=$i?></option>
        <?php
      }
    ?>
  </select>
  <label for="">CVV2</label>
  <input type="text" name="" value="">
  <input type="hidden" name="total" value="<?=$templateVars[0]?>">
  <input type="hidden" name="order" value="<?=$templateVars[1]?>">
  <input type="submit" name="submit" value="Submit Order">
</form>
