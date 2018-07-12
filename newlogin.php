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
	session_start(); 
//cnnect to the database
  $db = new mysqli("localhost","root","","vaccitright");
//echo $_SESSION['msg'];
$msg=$_SESSION['msg'];

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
{   $_SESSION['userid']=$userid;
	header("Location:group_childschedule.php");		
		
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
							 
							  <form class="form-horizontal" role="form" action="newlogin.php" method="post">
							 
							 
							 
							 
							 
							 
							 <center>  <div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group">
                                          
                                         <p><?php echo $msg;?></p>
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
                                          <input type="text" placeholder="User Name" name="uname" class="form-control">
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

                                          <input type="password" placeholder="Password" name="pass" class="form-control">
                                       </div>
                                    </div>
                                 </div>
                              </div>

                              <div class="col-xs-12 col-sm-12 col-md-12">
                                  <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                       <a href="#forgot" data-toggle="modal"> Forgot Password? </a>
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
	</body>
</html>
