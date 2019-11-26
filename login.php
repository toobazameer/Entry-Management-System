<?php
// Starting session
session_start();
?>
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
<?php include 'header1.php'; ?>
<br>
  <div class="text-center m-3 ">
    <h3><b> Login Successful!!</b> <br> Click Logout to get the details about the session via mail (The host has got the mail and sms about your session).
    </h3>
<h4>You can access our services (About Us Page)</h4> 
</div>
  <div class="m-5 ">
<?php
$con= mysqli_connect('localhost','root');
if($con){
  echo "Connection established";
}
else 
{
  echo "Unable to process the request";
}
mysqli_select_db($con, 'ems');

 $name=$_POST['name'];
 $email = $_POST['email'];
 $value= $_POST['ph_no'];
$query="INSERT INTO `user_info`(name,ph_no,email) VALUES ('$name','$value','$email')";
mysqli_query($con, $query);
echo "<br>";
echo "Name: ".$name;
echo "<br>";
echo "Phone Number: ".$value;
echo "<br>";
echo "Email: ".$email;
echo "<br>";
echo "Host Name: ".gethostname();
$_SESSION["sname"] = $name;
$_SESSION["sph_no"] = $value;
$_SESSION["semail"] = $email;
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
echo "<br>"."Address Visited :".$vis_ip; 

if(isset($_POST['name'])) {
      require 'PHPMailerAutoload.php';
      require 'credential.php';

      $mail = new PHPMailer;

      //$mail->SMTPDebug = 4;                               // Enable verbose debug output

      $sql="SELECT * FROM user_info WHERE name='$name' AND ph_no='$value' AND email='$email'";

      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_assoc($result);

      $mail->isSMTP();                                      // Set mailer to use SMTP
      $mail->Host = 'smtp.gmail.com';         // Specify main and backup SMTP servers
      $mail->SMTPAuth = true;                               // Enable SMTP authentication
      $mail->Username = EMAIL;                 // SMTP username
      $mail->Password = PASS;                  // SMTP password
      $mail->SMTPSecure = 'tls';               // Enable TLS encryption, `ssl` also accepted
      $mail->Port = 587;                                    // TCP port to connect to

      $mail->setFrom(EMAIL, 'Entry Management System');
      $mail->addAddress('Enterthehostemailaddress');    // Add a recipient

      $mail->isHTML(true);                 // Set email format to HTML

      $mail->Subject = 'Session Details by Host';      
      $mail->Body =  '<p><b>Name:</b>&nbsp;&nbsp;&nbsp;'.$row['name'].'</p>'; 
      $mail->Body.= '<p><b>Email: </b>&nbsp;&nbsp;&nbsp;'.$row['email'].'</p>';  
      $mail->Body.= '<p><b>Phone:</b>&nbsp;&nbsp;&nbsp;'.$row['ph_no'].'</p>';    
      $mail->Body.= '<p><b>Check-in Time:</b>&nbsp;&nbsp;&nbsp;'.$row['check_in'].'</p>';
      $mail->Body.= '<p><b>Host name:</b>&nbsp;&nbsp;&nbsp;'.gethostname().'</p>';  
      $mail->Body.= '<p><b>Address Visited:</b>&nbsp;&nbsp;&nbsp;'.$vis_ip.'</p>';  
      
      $mail->AltBody = 'Hey..';
    
    $number=XXXXXXXXXX; //Host number
    $text="Name: ".$row['name']."\nEmail: ".$row['email']."\nPhone: ".$row['ph_no']."\nCheck-in Time: ".$row['check_in']."\nHost name: ".gethostname()."\nAddress Visited: ".$vis_ip;

$url="www.way2sms.com/api/v1/sendCampaign";
$message = urlencode($text);// urlencode your message
$curl = curl_init();
curl_setopt($curl, CURLOPT_POST, 1);// set post data to true
curl_setopt($curl, CURLOPT_POSTFIELDS, "apikey=PasteAPI&secret=PasteSecretCode&usetype=stage&phone=$number&senderid=SenderMailId&message=$message");// post data
// query parameter values must be given without squarebrackets.
 // Optional Authentication:
curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);

}
?>
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

