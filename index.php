<!DOCTYPE html>
<html>
<head>
	<title>Entry Management System</title>
	 <meta charset="utf-8">
     <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
     <link rel="stylesheet" href="css/style.css" type="text/css">
     <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Josefin+Sans&display=swap">
     <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
function validateForm() {
  var x = document.forms["login"]["name"].value;
  var letters = /^[A-Za-z\s]+$/;
      if(x.match(letters));
      else
      {
      alert('Please input alphabet characters only');
      return false;
      }
     var y= document.forms["login"]["ph_no"].value;
      if(y.length!=10){
      alert("Invalid Mobile number");
      return false;
      }
     var z = document.forms["login"]["email"].value;  
     var em= /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
     if (z.match(em));
     else
    {
    alert("Please enter a valid email address!")
    return false;
}
}
</script>
</head>
<body>
<?php include 'header.php'; ?>

<div class='text-center'>
	<section class='p-1 m-1' >
		<h3><button type="button" class="btn btn-primary" data-toggle="popover" title="Please fill the form to establish your session." data-content="Happy Working!!">Login here to proceed futher</button></h3>
	</section>
</div> 
 <div class="w-50 m-auto">
 	<form method="POST" action="login.php" enctype="multipart/form-data" name="login" onsubmit="return validateForm()">
 		<div class="form-group">
 			<label>Name</label>
 			<input type="text" id="name" name="name"class="form-control" placeholder="Enter your name here" required>
 		</div> 
 		<div class="form-group">
 			<label >Phone Number</label>
 			<input type="number" id="ph_no" name="ph_no" class="form-control" placeholder="Enter your phone number here" required maxlength="10"></div> 
 			<div>
 			<div class="form-group">
 			<label>Email</label>
 			<input type="text" id="email" name="email" class="form-control" placeholder="Enter your email here" required>
 		</div> 
 			<button type="submit" class="btn btn-success" >Submit</button>
 		    </div>
 		</form>
 	</div>

  <br>
  <div class="w3-container w3-teal"> 
  	<hr>
   <?php include 'footer.php'; ?>
   </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>

