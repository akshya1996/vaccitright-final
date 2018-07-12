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
if ( isset( $_POST['loginpage'] ) ) 
 {
	header("Location:login.php");	 
 }
if ( isset( $_POST['resetpassword'] ) ) 
 {
$email=trim($_POST['email']);
$code=trim($_POST['cc']);
$query = "SELECT email,code FROM passwordcode WHERE email='$email'";
$result=$db->query($query);  
$row = $result->fetch_array();
$email=$row[0];
$password=$row[1];
if($code==$password)
{
	$query = "delete FROM passwordcode WHERE email='$email'";
$result=$db->query($query);
	
	
	header("Location:resetpassword2.php");	
}
else
{
	$msg="Your confirmation code is incorrect. Request for confirmation code and try again";
     $query = "delete FROM passwordcode WHERE email='$email'";
$result=$db->query($query);
	
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
                              <h2 class="text-center" style="color: #204d74;"> <strong> RESET PASSWORD  </strong></h2><hr />
							  
							    <form class="form-horizontal" role="form" action="resetpassword1.php" method="post">
							  
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
                                          <input type="text" placeholder="Enter registered email" name="email" class="form-control" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>
							  <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          <div class="input-group-addon">
                                             <span class="glyphicon glyphicon-user"></span>
                                          </div>
                                          <input type="text" placeholder="Enter confirmtion code" name="cc" class="form-control" required>
                                       </div>
                                    </div>
                                 </div>
                              </div>

                   

                             
                              <hr />
						
                              <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                   <input type="submit" class="btn btn-primary btn-lg btn-block" name="resetpassword" value="Reset Password">
                                 </div>
                              </div>
							   <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                   <input type="submit" class="btn btn-success btn-lg btn-block" name="loginpage" value="Login">
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
 
	</body>
</html>
