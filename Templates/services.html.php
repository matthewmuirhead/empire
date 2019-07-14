<label for="">Day of Week:</label>
<select class="" name="day">
  <option value="Monday">Monday</option>
  <option value="Monday">Tuesday</option>
  <option value="Monday">Wednesday</option>
  <option value="Monday">Thursday</option>
  <option value="Monday">Friday</option>
  <option value="Monday">Saturday</option>
</select>
<label for="">Start Time:</label>
<select class="" name="starthour">
  <?php
    for ($i=9; $i < 19; $i++) {
      if ($i < 10) {
        echo '<option value='.$i.'>0'.$i.'</option>';
      } else {
        echo '<option value='.$i.'>'.$i.'</option>';
      }
    }
  ?>
</select>
<select class="" name="startminute">
  <?php
    for ($i=0; $i < 60; $i++) {
      if ($i < 10) {
        echo '<option value='.$i.'>0'.$i.'</option>';
      } else {
        echo '<option value='.$i.'>'.$i.'</option>';
      }
    }
  ?>
</select>
<label for="">End Time:</label>
<select class="" name="endhour">
  <?php
    for ($i=9; $i < 19; $i++) {
      if ($i < 10) {
        echo '<option value='.$i.'>0'.$i.'</option>';
      } else {
        echo '<option value='.$i.'>'.$i.'</option>';
      }
    }
  ?>
</select>
<select class="" name="endminute">
  <?php
    for ($i=0; $i < 60; $i++) {
      if ($i < 10) {
        echo '<option value='.$i.'>0'.$i.'</option>';
      } else {
        echo '<option value='.$i.'>'.$i.'</option>';
      }
    }
  ?>
</select>
<label for="">Number of Weeks:</label>
<input type="number" name="duration" value="1" min="1">
