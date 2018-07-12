<?php

session_start(); 
$feedbackmsg="";
 $db = new mysqli("localhost","root","","vaccitright");
if ( isset( $_POST['feedback'] ) ) 
 {	
// Include and initialize phpmailer class
require 'PHPMailerAutoload.php';
$mail = new PHPMailer;
$email=$_POST['email'];
$comments=$_POST['comments'];
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
$mail->Subject = 'Feedback Received';

// Set email format to HTML
$mail->isHTML(true);

// Email body content
$mailContent = "<h1>Thanks for writing to us</h1>
    <p>Your feedback is precious and we will look into it and get back to you as soon as possible</p>
	<p>Thanks,</p>
	<p>Vaccitright team</p>
	";
	
$mail->Body = $mailContent;

// Send email
if(!$mail->send()){
  //  echo 'Message could not be sent.';
   // echo 'Mailer Error: ' . $mail->ErrorInfo;
    $feedbackmsg="Enter valid email address";
}else{
    $feedbackmsg="Feedback sent successfully";
}
//storing feedback in the database

$query3 = "INSERT INTO feedback (email, comments, time) VALUES('$email','$comments',now())";
 $sql = $db->query($query3);






 }


?>


<html>
<head>
	<link rel="stylesheet" href="css/styles.css">
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<script src="js/jquery-3.3.1.min.js"></script>
	<script src="js/script.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0">



</head>
<body>

<div class="container-fullwidth">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="home.html">My child Vaccines</a>
			</div>
			<div class="collapse navbar-collapse js-navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="home.html">Home</a>
					</li>
					<li class="dropdown">
						<a href="faqPage.html">FAQ</a>
					</li>
					<li class="dropdown">
						<a href="about.html">About</a>
					</li>
					<li class="dropdown">
						<a href="location.html">Location</a>
					</li>
					<li class="dropdown">
						<a href="feedback.html">Feedback</a>
					</li>
				</ul>
			</div>
		</nav>
	</div>

		
		
<div class="page-content inset" data-spy="scroll" data-target="#spy">
    <div class="container"> 
		<div class="col-md-3"></div>
        <div style="margin-top:50px;" class="col-md-6 ">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Feedback Form</div>
                        
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >
                            
                        <form class="form-horizontal" role="form" action="feedback.php" method="post">
						
						<center><div>
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                         
                                        <p><b><?php echo $feedbackmsg;?></b></p>
                                       </div>
                                    </div>
                                 </div>
                              </div></center>
							<div>
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          <div class="input-group-addon">
                                             <span class="glyphicon glyphicon-user"></span>
                                          </div>
                                          <input type="email" placeholder="E-mail" name="email" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                              </div>
							  <div>
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                   <div class="form-group">
										<label for="comment">Comment:</label>
										<textarea class="form-control" rows="5" id="comment" name="comments" placeholder="Enter Feedback"></textarea>
									</div>
                                 </div>
                              </div>
                                
                                  <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                  <center>
                                    <div class="col-sm-12 controls">
                                     
                                        <input type="submit" class="btn btn-primary btn-lg btn-block" name="feedback" value="Send Feedback">

                                    </div>
									</center>
                                </div>
                           </form>
					    



                        </div>                     
                    </div>  
        </div>
        
                    </div>
					</div>
</body>
</html>