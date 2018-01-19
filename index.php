<?php
  include_once 'includes/dbh.inc.php';
  include('includes/form_process.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="form.css" type="text/css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>

  <!-- Date picker -->
</head>
<body>
<?php

//Created a template
  $sql = "SELECT * FROM guests WHERE name=?;";
 //Create a prepared statement
  $stmt = mysqli_stmt_init($conn);
  //Prepare the prepared statement
  if (!mysqli_stmt_prepare($stmt, $sql)) {
      echo "SQL statement failed";
  } else{
      //bind parameters to the placeholder
    mysqli_stmt_bind_param($stmt, "s", $data);
    //run parameters inside database
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    while ($row = mysqli_fetch_assoc($result)) {
      echo $row['name'] . "<br>";
    }
  }

?>
<div class="container">
  <h2>Reservations form</h2>
  <form id="contact" action="includes/reserve.inc.php" method="POST">
     <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required>
    </div>
    
    <div class="form-group">
      <label for="surname">Surame:</label>
      <input type="text" class="form-control" id="surname" placeholder="Enter surname" name="surname"  required>
    </div>
    <div class="form-group">
      <label for="phone">Phone:</label>
      <input type="text" class="form-control" id="phone" placeholder="Enter phone number" name="phone"  required>
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"  required>
    </div>
    <div class="form-group">
      <label for="checkInDate">Check in date:</label>
      <input type="date" min="2018-01-01" class="form-control" id="checkInDate" placeholder="Enter check in date" name="checkInDate"  required>
    </div>
    <div class="form-group">
      <label for="checkOutDate">Check out date:</label>
      <input type="date" min="2018-01-01" class="form-control" id="checkOutDate" placeholder="Enter check out date" name="checkOutDate"  required>
    </div>
    <div class="checkbox">
      <label><input type="checkbox" name="remember"> Remember me</label>
    </div>
    <button type="submit" class="btn btn-default" name="submit">Book reservation</button>
    <span id="availability"></span>
  </form>
</div>

</body>
</html>
<script>
  $(document).ready(function()
  {
     $('$name').blur(function()
     {
      var checkInDate = $(this).val();
      $.ajax({
        url:"db.inc.php",
        method:"POST",
        data:{name:name},
        dataType:"text",
        success:function(php)
        {
          $('#availability').php(php);
        }
      });
     });
  });
</script>