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
</head>
<body>
<?php include 'header1.php';
 function getVisIpAddr() { 
      
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) { 
        return $_SERVER['HTTP_CLIENT_IP']; 
    } 
    else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) { 
        return $_SERVER['HTTP_X_FORWARDED_FOR']; 
    } 
    else { 
        return $_SERVER['REMOTE_ADDR']; 
    } 
} 
$vis_ip = getVisIPAddr(); 
session_start();

$con= mysqli_connect('localhost','root');
if($con);
else 
{
  echo "Unable to process the request";
}
mysqli_select_db($con, 'ems');
$name=$_SESSION['sname'];
$ph_no=$_SESSION['sph_no'];
$email=$_SESSION['semail'];
$sql="SELECT * FROM user_info WHERE name='$name' AND ph_no='$ph_no' AND email='$email'";




    if(isset($_POST['sendmail'])) {
      require 'PHPMailerAutoload.php';
      require 'credential.php';
      $query="UPDATE `user_info` SET `check_out`=(now()) WHERE name='$name' AND ph_no='$ph_no' AND email='$email'";
      mysqli_query($con, $query);
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_assoc($result);
      $mail = new PHPMailer;

      //$mail->SMTPDebug = 4;                               // Enable verbose debug output

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';         // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = EMAIL;                 // SMTP username
      $mail->Password = PASS;                  // SMTP password
      $mail->SMTPSecure = 'tls';               // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      $mail->setFrom(EMAIL, 'Entry Management System');
      $mail->addAddress($row['email']);    // Add a recipient

      $mail->isHTML(true);                 // Set email format to HTML

      $mail->Subject = 'Session Details';      
      $mail->Body =  '<p><b>Name:</b>&nbsp;&nbsp;&nbsp;'.$row['name'].'</p>'; 
      $mail->Body.= '<p><b>Phone :</b>&nbsp;&nbsp;&nbsp;'.$row['ph_no'].'</p>';    
      $mail->Body.= '<p><b>Check In Time:</b>&nbsp;&nbsp;&nbsp;'.$row['check_in'].'</p>';  
      $mail->Body.= '<p><b>Check Out Time:</b>&nbsp;&nbsp;&nbsp;'.$row['check_out'].'</p>';  
      $mail->Body.= '<p><b>Hostname:</b>&nbsp;&nbsp;&nbsp;'.gethostname().'</p>';  
      $mail->Body.= '<p><b>Address Visited:</b>&nbsp;&nbsp;&nbsp;'.$vis_ip.'</p>';  
      
      $mail->AltBody = 'Hey..';

      if(!$mail->send()) {
          echo 'Message could not be sent.';
          //echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
          echo 'Email has been sent';
      }
    header('Location:index.php');
    }
   ?>
   <div class='m-5 p-5 w-10'>
        <form role="form" method="post" enctype="multipart/form-data">
          <div >
          <button type="submit" name="sendmail" class="btn btn-lg btn-success btn-block" >Click here to confirm Logout</button>
          </div>
        </form>
  </div>
  <div class="w3-container w3-teal"> 
    <hr>
  <?php include 'footer.php'; ?>
   </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>