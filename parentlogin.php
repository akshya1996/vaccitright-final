<?php
session_start(); 
$db = new mysqli("localhost","root","","vaccitright");
//echo $_SESSION['msg'];
$msg="";
$userid=$_SESSION['userid'];
if(isset($_SESSION['childid']))
{
$childid=$_SESSION['childid'];
}
else
{
$childid="";
}

	
	

?>
<!DOCTYPE html>
<html>
	<head>
		<title>Home Page</title>
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="js/jquery-3.3.1.min.js"></script>
		<script src="js/script.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<meta name="viewport" content="width=device-width,height=device-height, initial-scale=1.0">
	</head>
	<body>
		<div class="container-fluid">
			<div class="row">
				<!-- <nav class="navbar navbar-inverse">
					  <div class="container-fluid">
						<div class="navbar-header">
						  <a class="navbar-brand" href="parentlogin.html">My  child vaccines</a>
						</div>
						<ul class="nav navbar-nav fright">
						  <li class="dropdown ">
							<a class="dropdown-toggle" data-toggle="dropdown" href="#">Parent Name
							<span class="caret"></span></a>
							<ul class="dropdown-menu ">
							  <li><a href="#">Account Settings</a></li>
							  <li><a href="login.html">Logout</a></li>
							</ul>
						  </li>
						</ul>
					  </div>
				</nav> -->
				 <div class="container-fullwidth">
    <nav class="navbar navbar-inverse">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">My Child Vaccines</a>
      </div>

      <div class="collapse navbar-collapse js-navbar-collapse">

        <ul class="nav navbar-nav navbar-right">
          <li class="dropdown">
            <a href="group_childschedule.php">Home</span></a>
          </li>
          <li><a href="home.html">Logout</a></li>
        </ul>
      </div><!-- /.nav-collapse -->
    </nav>
  </div>

				<div class="fright mr10">
					<a role="button" class="btn btn-danger" href="group_childschedule.php">
						<span class="glyphicon glyphicon-plus"></span>
						Create New schedule
					</a>
				</div><br><br><br>

				<?php
	$query = "SELECT C.cfname,C.childid from child C, user U where C.userid=U.userid and U.userid='$userid'";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              $dcfname=$row['cfname'];
			  $dfchildid=$row['childid'];

			
				
				
				
				?>
				<div class="col-md-4 h250">
					<div class="panel panel-default">
						<div class="panel-heading"><?php echo $row['cfname'];?></div>
						<div class="panel-body">
						 <form class="form-horizontal" role="form" action="addnewschedule.php" method="post">
						<?php
						$querys = "SELECT V.vaccinename from vaccine V, vacc_child VC where V.vaccineid=VC.vid and VC.childid='$dfchildid'";
       if($results = mysqli_query($db, $querys)){
        if(mysqli_num_rows($results) > 0){
      
          while($rows = mysqli_fetch_array($results))
          {
						?>
							<div><?php echo $rows['vaccinename']?><span class="glyphicon glyphicon-ok fright"></span></div>
							<hr>
							
							<?php
							}
          }
        }
							
							?>
								<?php
						$queryss = "SELECT V.evaccname from externalvacc V, evacc_child VC where V.evaccid=VC.evid and VC.childid='$dfchildid'";
       if($resultss = mysqli_query($db, $queryss)){
        if(mysqli_num_rows($resultss) > 0){
      
          while($rowss = mysqli_fetch_array($resultss))
          {
						?>
							<div><?php echo $rowss['evaccname']?><span class="glyphicon glyphicon-ok fright"></span></div>
							<hr>
							
							<?php
							}
          }
        }
							
							?>
							<input type="hidden" name="dfchildid" class="form-control" value="<?php echo $dfchildid; ?>">
							<input type="submit" class="btn btn-primary btn-lg btn-block" name="viewedit" value="View/Edit">
						</form>
						</div>
					</div>
				</div>
			<?php
 }
          }
        }


?>			
				
				
			</div>
		</div>
		
	</body>
</html>