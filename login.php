<?php
session_start(); 

?>




<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/script.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0">
	</head>
	<body>
	<?php
 
//cnnect to the database
  $db = new mysqli("localhost","root","","vaccitright");
//echo $_SESSION['msg'];
$msg="";
	
//check if the user is present in the database

if ( isset( $_POST['sendcc'] ) ) 
 {
$email=trim($_POST['email']);
$query = "SELECT email,password FROM user WHERE email='$email'";
$result=$db->query($query);  
$row = $result->fetch_array();
$email=$row[0];
$password=$row[1];
$alphaLength = strlen($password) - 1; //put the length -1 in cache
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $password[$n];
    }
$code=implode($pass);
//store this detail in password code
$query3 = "INSERT INTO passwordcode (email, password, code) VALUES('$email','$password','$code')";
$sql = $db->query($query3);
//send an email




require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$email=$_POST['email'];
// SMTP configuration
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'sakshyaraghavan@gmail.com';
$mail->Password = 'incorrect@0';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

$mail->setFrom('no-reply-email@vaccitright.com', 'VaccitRight');
$mail->addReplyTo('no-reply-email@vaccitright.com', 'Vaccitright');

// Add a recipient
$mail->addAddress($email);

// Add cc or bcc 

// Email subject
$mail->Subject = 'Password Reset Code';

// Set email format to HTML
$mail->isHTML(true);

// Email body content
$mailContent = "<h1>Reset Code</h1>
    <p>Your password reset code is :</p>
	<p><b>".$code."</b></p>
	<p>Thanks,</p>
	<p>Vaccitright team</p>
	";
	
$mail->Body = $mailContent;

// Send email
if(!$mail->send()){
  //  echo 'Message could not be sent.';
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
   // $feedbackmsg="Enter valid email address";
}else{
  //  $feedbackmsg="Feedback sent successfully";
}



header("Location:resetpassword1.php");



	 
	 
	 
	 
	 
 }


if ( isset( $_POST['login'] ) ) 
 {	
	$uname=$_POST['uname'];
	
	$pass=$_POST['pass'];
	
	$query = "SELECT userid,email,password FROM user WHERE email='$uname'";
$result=$db->query($query);  
$row = $result->fetch_array();
$userid=$row[0];
$email=$row[1];
$password=$row[2];
if($pass!=$password)
{
	$msg="credentials are wrong";
}	
else
{ 
if($uname="" && $password="")
{
	$msg="Please enter credentials to login";
}
else{


$_SESSION['userid']=$userid;
header("Location:group_childschedule.php");
		
}	
}	
 }
	
	?>
	<nav class="navbar navbar-inverse">
	  <div class="container-fluid">
		<div class="navbar-header">
		  <a class="navbar-brand" href="home.html">My Child Vaccines</a>
		</div>
		<ul class="nav navbar-nav fright">
		  <li class="active"><a href="home.html">Home</a></li>
		  <li><a href="about.html">About</a></li>
		  <li><a href="loaction.html">Location</a></li>
		  <li><a href="faqpage.html">FAQ's</a></li>
		  <li><a href="feedback.html">Feedback</a></li>
		</ul>
	  </div>
	</nav>
	<div class="container">
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">
        <div class="panel with-nav-tabs panel-info">
			<div class="panel-body">
				<div class="tab-content">
                  <div id="login" class="tab-pane fade in active register">
                     <div class="container-fluid">
                        <div class="row">
                              <h2 class="text-center" style="color: #204d74;"> <strong> Login  </strong></h2><hr />
							  
							    <form class="form-horizontal" role="form" action="login.php" method="post">
							  
							 <center> 
							 <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          
                                         <p style="color:red;"><?php echo $msg;?></p>
                                       </div>
                                    </div>
                                 </div>
                              </div></center>

                              <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          <div class="input-group-addon">
                                             <span class="glyphicon glyphicon-user"></span>
                                          </div>
                                          <input type="text" placeholder="User Name" name="uname" class="form-control" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          <div class="input-group-addon">
                                             <span class="glyphicon glyphicon-lock"></span>
                                          </div>

                                          <input type="password" placeholder="Password" name="pass" class="form-control" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                       <a data-toggle="modal" href="#forgot" data-scroll> Forgot Password? </a>
                                    </div>
                                 </div>
                              </div>
                              <hr />
							  <div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">new user?
                                       <a href="register.php" >Click here to register</a>
                                    </div>
							  </div>
                              <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                   <input type="submit" class="btn btn-primary btn-lg btn-block" name="login" value="Login">
                                 </div>
                              </div>
                         </form>
                        </div>
                     </div> 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
  <div class="modal fade" id="forgot" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Forgot Password?</b></h4>
        </div>
        <div class="modal-body">
          <p>Type your registered email to recover your password</p>
          
		  <form class="form-horizontal" role="form" action="login.php" method="post">
		   <center><div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          
                                          <input type="text" placeholder="Enter registered email" name="email" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                              </div>
			<div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group"> 
                                         <input type="submit" class="btn btn-success btn-block" name="sendcc" value="Send>">
                                       </div>
                                    </div>
                                 </div>
                              </div>

		  </center>
		  </form>
		  
		 
        </div>
      </div>
      
    </div>
  </div> 
  
	</body>
</html>
