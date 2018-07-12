<?php
session_start(); 
$db = new mysqli("localhost","root","","vaccitright");
$userid=$_SESSION['userid'];
if ( isset( $_POST['deleteaccount'] ) ) 
 {
$query = "SELECT childid from child where userid='$userid'";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
			  $childid=$row['childid'];
			 $query3 = "DELETE FROM vacc_child WHERE childid='$childid'";
             $sql = $db->query($query3); 
			 $query3 = "DELETE FROM evacc_child WHERE childid='$childid'";
             $sql = $db->query($query3); 
			 $query3 = "DELETE FROM child WHERE childid='$childid'";
             $sql = $db->query($query3); 
			 
			  
	   } }}
		  $query3 = "DELETE FROM user WHERE userid='$userid'";
             $sql = $db->query($query3); 
header("Location:home.html");	 
	 
	 
	 
	 
	 
 }
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
?>

<html>
<head>
<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/script.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0">
<style>

@import url(http://fonts.googleapis.com/css?family=Open+Sans:400,700);
body {
  font-family: 'Open Sans', 'sans-serif';
}


.carousel-control {
  width: 30px;
  height: 30px;
  top: -35px;

}
.left.carousel-control {
  right: 30px;
  left: inherit;
}
.carousel-control .glyphicon-chevron-left, 
.carousel-control .glyphicon-chevron-right {
  font-size: 12px;
  background-color: #fff;
  line-height: 30px;
  text-shadow: none;
  color: #333;
  border: 1px solid #ddd;
}

.navbar{
    border-radius: 0px !important
	width:100% !important;
}

.panel-info {
    border-color: #696768 !important;
	}

.panel-info>.panel-heading {
    color: #e7eef1 !important;
    background-color: #4a4d4e !important;
    border-color: #696768 !important;
	 

}
#wrapper {
  padding-left: 250px;
  transition: all 0.4s ease 0s;
}

#sidebar-wrapper {
  margin-left: -250px;
  left: 250px;
  width: 250px;
  background: #000;
  position: fixed;
  height: 100%;
  overflow-y: auto;
  z-index: 1000;
  transition: all 0.4s ease 0s;
}

#wrapper.active {
  padding-left: 0;
}

#wrapper.active #sidebar-wrapper {
  left: 0;
}

#page-content-wrapper {
  width: 100%;
}



.sidebar-nav {
  position: absolute;
  top: 0;
  width: 250px;
  list-style: none;
  margin: 0;
  padding: 0;
  
}

.sidebar-nav li {
  line-height: 40px;
  text-indent: 20px;
}

.sidebar-nav li a {
  color: #999999;
  display: block;
  text-decoration: none;
  padding-left: 60px;
}

.sidebar-nav li a span:before {
  position: absolute;
  left: 0;
  color: #41484c;
  text-align: center;
  width: 20px;
  line-height: 18px;
}

.sidebar-nav li a:hover,
.sidebar-nav li.active {
  color: #fff;
  background: rgba(255,255,255,0.2);
  text-decoration: none;
}

.sidebar-nav li a:active,
.sidebar-nav li a:focus {
  text-decoration: none;
}

.sidebar-nav > .sidebar-brand {
  height: 65px;
  line-height: 60px;
  font-size: 18px;
}

.sidebar-nav > .sidebar-brand a {
  color: #999999;
}

.sidebar-nav > .sidebar-brand a:hover {
  color: #fff;
  background: none;
}



.content-header {
  height: 65px;
  line-height: 65px;
}

.content-header h1 {
  margin: 0;
  margin-left: 20px;
  line-height: 65px;
  display: inline-block;
}

#menu-toggle {
    text-decoration: none;
}

.btn-menu {
  color: #000;
} 

.inset {
  padding: 20px;
}

@media (max-width:767px) {

#wrapper {
  padding-left: 0;
}

#sidebar-wrapper {
  left: 0;
}

#wrapper.active {
  position: relative;
  left: 250px;
}

#wrapper.active #sidebar-wrapper {
  left: 250px;
  width: 250px;
  transition: all 0.4s ease 0s;
}

#menu-toggle {
  display: inline-block;
}

.inset {
  padding: 15px;
}

#sidebar-wrapper{

    top: 50px !important;
}

#spy a{
padding-top:5px !important;
padding-bottom: 5px !important;
}
</style>
<script>
	/*Menu-toggle*/
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
    });

    /*Scroll Spy*/
    $('body').scrollspy({ target: '#spy', offset:80});

    /*Smooth link animation*/
    $('a[href*=#]:not([href=#])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') || location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html,body').animate({
                    scrollTop: target.offset().top
                }, 1000);
                return false;
            }
        }
    });

</script>

</head>
<body>
<?php 

//cnnect to the database
$db = new mysqli("localhost","root","","vaccitright");
$userid=$_SESSION['userid'];








?>
<div class="container-fullwidth">
  <nav class="navbar navbar-inverse">
    <div class="navbar-header">
		<a class="navbar-brand" href="#">My Child Vaccines</a>
	</div>
	
	<div class="collapse navbar-collapse js-navbar-collapse">
		
        <ul class="nav navbar-nav fright">
		
        <li class="dropdown">
          <a href="group_childschedule.php">Home</span></a>
        </li>
		  <li class="dropdown ">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings
							<span class="caret"></span></a>
							<ul class="dropdown-menu ">
							  <li><a data-toggle="modal" href="#forgot" data-scroll>Change Password</a></li>
							  <li><a data-toggle="modal" href="#deleteacc" data-scroll>Delete Account</a></li>
							</ul>
						  </li>
        <li><a href="home.html">Logout</a></li>
     
	  
						
						</ul>
	</div><!-- /.nav-collapse -->
  </nav>
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
          <p>Type your registered email to change your password</p>
          
		  <form class="form-horizontal" role="form" action="group_childschedule.php" method="post">
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



  
  
  
<div class="modal fade" id="deleteacc" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Forgot Password?</b></h4>
        </div>
        <div class="modal-body">
          <p>Are you sure you want to delete your account?</p>
          <p>Remember you will lose all your information</p>
		  <form class="form-horizontal" role="form" action="group_childschedule.php" method="post">
		   <center>
			<div class="row">
                                 <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                       <div class="input-group"> 
                                         <input type="submit" class="btn btn-success btn-block" name="deleteaccount" value="Delete Account">
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





<div id="wrapper">
<div id="sidebar-wrapper">
            <nav id="spy">
                <ul class="sidebar-nav nav">
					<center><p style="color:white;padding-top:10px;">KNOW YOUR VACCINES</p></center>
                    <li>
                        <a data-toggle="modal" href="#myModal"data-scroll>
                            <span class="fa fa-anchor solo">DTaP</span>
                        </a>
												
                    </li>
                    <li>
                        <a data-toggle="modal" href="#hepaModal"data-scroll>
                            <span class="fa fa-anchor solo">HepA</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" href="#hepbModal" data-scroll>
                            <span class="fa fa-anchor solo">HepB</span>
                        </a>
                    </li>
                    <li>
                        <a data-toggle="modal" href="#hibModal" data-scroll>
                            <span class="fa fa-anchor solo">Hib</span>
                        </a>
                    </li>
					 <li>
                        <a data-toggle="modal" href="#ipvModal" data-scroll>
                            <span class="fa fa-anchor solo">IPV</span>
                        </a>
                    </li>
					 <li>
                        <a data-toggle="modal" href="#mmrModal" data-scroll>
                            <span class="fa fa-anchor solo">MMR</span>
                        </a>
                    </li>
					 <li>
                        <a data-toggle="modal" href="#pcvModal" data-scroll>
                            <span class="fa fa-anchor solo">PCV</span>
                        </a>
                    </li>
					 <li>
                        <a data-toggle="modal" href="#rotaModal" data-scroll>
                            <span class="fa fa-anchor solo">Rota</span>
                        </a>
                    </li>
					 <li>
                        <a data-toggle="modal" href="#varModal" data-scroll>
                            <span class="fa fa-anchor solo">VAR</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
		
		
<div class="page-content inset" data-spy="scroll" data-target="#spy">
    <div class="container">    
        <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title">Create a New Schedule</div>
                        
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form class="form-horizontal" role="form" action="addnewschedule.php" method="post">
                                    
                            <div style="margin-bottom: 25px" class="input-group-center">
                                      
                                    <input id="childname" type="text" class="form-control" name="cfname" value=""  placeholder="Child First Name" required >                                        
                                 
							</div>
							<div style="margin-bottom: 25px" class="input-group-center">
                                      
                                    <input id="childname" type="text" class="form-control" name="clname" value=""  placeholder="Child Last Name" >                                        
                                 
							</div>
							<div style="margin-bottom: 25px" >
                                      
                                   <select name="sex" class="form-control">
                                        <option value="Female" selected>Female</option>
                                        <option value="Male">Male</option>
             
                                   </select>                                        
                                 
							</div>
                                
                            <div style="margin-bottom: 25px" class="input-group-center">
							 
                                        <input id="birthdate" type="date"  required="true" class="form-control" name="birthdate" placeholder="Birth Date" >
                                  
									</div>
                                    

                                
                         


                                <div style="margin-top:10px" class="form-group">
                                    <!-- Button -->
                                  <center>
                                    <div class="col-sm-12 controls">
                                      <input type="submit" class="btn btn-danger btn-lg btn-block" name="addchildandmakescedule" value="Create Schedule">
                                     
                                    </div>
									</center>
                                </div>
                           </form>
						   <form action="parentlogin.php" id="loginform" class="form-horizontal" role="form" method="post" >

                                <div class="form-group">
                                    <div class="col-md-12 control">
									
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                         <center>   
                                        <input type="submit" class="btn btn-warning btn-lg btn-block" name="oeschedule" value="Open Existing Schedule">
										</center>
                                        </div>
                                    </div>
                                </div>    
                            </form>     
                            <form action="comparesymptoms.php" id="loginform" class="form-horizontal" role="form" method="post" >

                                <div class="form-group">
                                    <div class="col-md-12 control">
									
                                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                                         <center>   
                                        <input type="submit" class="btn btn-success btn-lg btn-block" name="oeschedule" value="Compare Symptoms">
										</center>
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
		 <!-- Modal Dtap starts here-->			
		<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Diphtheria, tetanus, and acellular pertussis (DTaP) vaccine</b></h4>
        </div>
        <div class="modal-body">
          <p>4-dose series at 2, 4, 6, and 15 to 18 months</p>
<p><b>Prospectively:</b> A 4th dose may be given as early as age 12 months if at least 6 months have elapsed since the 3rd dose.</p>
<p><b>Retrospectively:</b> A 4th dose that was inadvertently given as early as 12 months may be counted if at least 4 months have elapsed since the 3rd dose.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
  
  
  
  <div class="modal fade" id="hepbModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Hepatitis B (HepB) vaccine</b></h4>
        </div>
        <div class="modal-body">
          <p>A complete series is 3 doses at 0, 1 to 2, and 6 to 18 months</p>
<p>Infants who did not receive a birth dose should begin the series as soon as feasible </p>
<p>Administration of 4 doses is permitted when a combination vaccine containing HepB is used after the birth dose</p>
<p><b>Minimum age for the final dose: </b>24 weeks</p>
<p><b>Minimum intervals: </b>Dose 1 to Dose 2: 4 weeks / Dose 2 to Dose 3: 8 weeks / Dose 1 to Dose 3: 16 weeks</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
  
   <div class="modal fade" id="hibModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Haemophilus influenzae type b (Hib) conjugate vaccines</b></h4>
        </div>
        <div class="modal-body">
          <p><b>ActHIB, Hiberix, or Pentacel:</b> 4 to dose series at 2, 4, 6, and 12 to 15 months.</p>
<p><b>PedvaxHIB: </b>3-dose series at 2, 4, and 12 to 15 months.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>




 <!-- Modal Dtap starts here-->			
		<div class="modal fade" id="hepaModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Hepatitis A (HepA) vaccine</b></h4>
        </div>
        <div class="modal-body">
          <p>2 doses, separated by 6 to 18 months, between the 1st and 2nd birthdays</p>
          <p><b>Previously unvaccinated persons who should be vaccinated:</b></p>
		  <p>Persons traveling to or working in countries with high or intermediate HepA endemicity</p>
		  <p>Users of injection and non-injection drugs</p>
		  <p>Persons who work with hepatitis A virus in a research laboratory or with non-human primates</p>
		  <p>Persons with clotting-factor disorders</p>
		  <p>Persons with chronic liver disease</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>  
  
  
  
  <div class="modal fade" id="ipvModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Inactivated poliovirus vaccine</b></h4>
        </div>
        <div class="modal-body">
          <p>3-dose series at ages 2, 4, 6 to 18 months</p>
          
		  <p>In the first 6 months of life, use minimum ages and intervals only for travel to a polio-endemic region or during an outbreak</p>
		  <p>Users of injection and non-injection drugs</p>
		  <p>IPV is not routinely recommended for U.S. residents 18 years of age and older</p>
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> 




<div class="modal fade" id="mmrModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Measles, mumps, and rubella (MMR) vaccine</b></h4>
        </div>
        <div class="modal-body">
          <p>2 dose series at 12 to 15 months. The 2nd dose may be given as early as 4 weeks after the 1st dose</p>
          
		  <p>Unvaccinated children and adolescents: 2 doses at least 4 weeks apart</p>
		  
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>   

  
  <div class="modal fade" id="pcvModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Pneumococcal vaccines</b></h4>
        </div>
        <div class="modal-body">
          <p>4-dose series at 2, 4, 6, and 12 to 15 months</p>
          
		  <p>Administer PCV13 doses before PPSV23 if possible</p>
		  
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> 
  
  
  <div class="modal fade" id="rotaModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Rotavirus vaccines</b></h4>
        </div>
        <div class="modal-body">
          <p><b>Rotarix:</b> 2 dose series at 2 and 4 months</p>
<p><b>RotaTeq: </b>3 dose series at 2, 4, and 6 months</p>
<p>If any dose in the series is either RotaTeq or unknown, default to 3-dose series</p>
          
		  
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> 
  
  <div class="modal fade" id="varModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Varicella (VAR) vaccine</b></h4>
        </div>
        <div class="modal-body">
          <p>2 dose series: 12 to 15 months</p>
<p>The 2nd dose may be given as early as 3 months after the 1st dose </p>
          
		  
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> 
  
  
  
  
  




  

</body>
</html>