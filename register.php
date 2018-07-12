<!DOCTYPE html>
<html>
	<head>
		<title>Registration</title>
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
  
 $_SESSION['msg']="";
  $msg="";
  
if ( isset( $_POST['register'] ) ) 
 {
	// echo "user not present";
	 
  $fname=$_POST['fname'];
  $lname=$_POST['lname'];
  $sex=$_POST['sex'];
  $age=$_POST['age'];
  $email=$_POST['email'];
  $pass=trim($_POST['pass']);
  $cpass=trim($_POST['cpass']);
  $msg="";
	//check if the email is aready present in the database
$query = "SELECT * FROM user WHERE email='$email'";
$result=$db->query($query);  
$row = $result->fetch_array();
$rowcount=mysqli_num_rows($result);
if($rowcount==0)
{
	//echo "user not present";
	//add the user to the database
	//before that check if pass and cpass are same
	if($pass==$cpass)
	{
		//add the user to the database
		//and get the userid 
 $query3 = "INSERT INTO user (fname, lname, email, age, sex, password) VALUES('$fname','$lname','$email','$age','$sex','$pass')";
 $sql = $db->query($query3);
 
 $_SESSION['msg']="Successfully registered. Now login to continue";
header("Location:newlogin.php");		
		
		
		
	}
	else
	{
		$msg="passowords dont match";
	}
}
else
{
	$msg="user already registered";
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
			<div>
                <div class="container-fluid">
                    <div class="row">
						<div class="col-md-3"></div>
						<div class="col-md-6">
                        <h2 class="text-center" style="color: #204d74;"> <Strong> Register </Strong></h2> <hr />
						 <form class="form-horizontal" role="form" action="register.php" method="post">
						<center> <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                       
                                        <p style="color:red;"><?php echo $msg; ?></p>
                                    </div>
                                </div>
							</div>
						</div>
						</center>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon iga1">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter First Name" name="fname">
                                    </div>
                                </div>
							</div>
						</div>
						
						<div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon iga1">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter Last Name" name="lname">
                                    </div>
                                </div>
							</div>
						</div>
						<div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon iga1">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                      <div style="margin-bottom: 25px" >
                                      
                                   <select name="sex" class="form-control">
                                        <option value="Female" selected>Female</option>
                                        <option value="Male">Male</option>
             
                                   </select>                                        
                                 
							</div>
									  
									  
                                    </div>
                                </div>
							</div>
						</div>
						<div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon iga1">
                                            <span class="glyphicon glyphicon-user"></span>
                                        </div>
                                        <input type="text" class="form-control" placeholder="Enter age" name="age">
                                    </div>
                                </div>
							</div>
						</div>

						<div class="row">
							<div class="col-xs-12 col-sm-12 col-md-12">
								<div class="form-group">
                                          <div class="input-group">
                                             <div class="input-group-addon iga1">
                                                <span class="glyphicon glyphicon-envelope"></span>
                                             </div>
                                             <input type="email" class="form-control" placeholder="Enter E-Mail" name="email">
                                          </div>
                                </div>
                            </div>
                        </div>

                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                       <div class="form-group">
                                          <div class="input-group">
                                             <div class="input-group-addon iga1">
                                                <span class="glyphicon glyphicon-lock"></span>
                                             </div>
                                             <input type="password" class="form-control" placeholder="Enter Password" name="pass">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
								 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                       <div class="form-group">
                                          <div class="input-group">
                                             <div class="input-group-addon iga1">
                                                <span class="glyphicon glyphicon-lock"></span>
                                             </div>
                                             <input type="password" class="form-control" placeholder="Confirm Password" name="cpass">
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <hr>
								 <div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group">already a user?
                                       <a href="login.php" >Click here to login</a>
                                    </div>
							  </div>
                                 <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                       <div class="form-group">
                                             <input type="submit" class="btn btn-danger btn-lg btn-block" name="register" value="Register">
                                       </div>
                                    </div>
                                 </div>
					 </form>
						</div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</body>
</html>
