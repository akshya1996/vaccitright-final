<?php
session_start(); 
$db = new mysqli("localhost","root","","vaccitright");
$userid=$_SESSION['userid'];
if ( isset( $_POST['viewedit'] ) ) 
 {
	 $_SESSION['childid']=$_POST['dfchildid'];
	
 }




?>
<html>
<head>
  <!-- Latest compiled and minified CSS -->
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
    border-radius: 0px !important;
  }

  .panel-info {
    border-color: #696768 !important;
  }

  .panel-info>.panel-heading {
    color: #e7eef1 !important;
    background-color: #4a4d4e !important;
    border-color: #696768 !important;


  }
  .panel-table .panel-body{
    padding:0;
  }

  .panel-table .panel-body .table-bordered{
    border-style: none;
    margin:0;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
    text-align:center;
    width: 100px;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
  .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
    border-right: 0px;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
  .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
    border-left: 0px;
  }

  .panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
    border-bottom: 0px;
  }

  .panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
    border-top: 0px;
  }

  .panel-table .panel-footer .pagination{
    margin:0; 
  }

/*
used to vertically center elements, may need modification if you're not using default sizes.
*/
.panel-table .panel-footer .col{
 line-height: 34px;
 height: 34px;
}

.panel-table .panel-heading .col h3{
 line-height: 30px;
 height: 30px;
}

.panel-table .panel-body .table-bordered > tbody > tr > td{
  line-height: 34px;
}
</style>


<script>
function myFunction() {
    window.print();
}



</script>



</head>
<body>
<?php

//cnnect to the database
  $db = new mysqli("localhost","root","","vaccitright");
  
//add child to the database
//***********************************chnage userid based on the session *****************************************************************

//to delete child
if ( isset( $_POST['deletechild'] ) ) 
 {
	 $childid=$_SESSION['childid'];
	
$query3 = "delete from vacc_child where childid='$childid'";
$sql = $db->query($query3);	 
$query3 = "delete from evacc_child where childid='$childid'";
$sql = $db->query($query3);	 
$query3 = "delete from child where childid='$childid'";
$sql = $db->query($query3);
header("Location:parentlogin.php");	  
 }


 if ( isset( $_POST['addchildandmakescedule'] ) ) 
 {

$cfname=trim($_POST['cfname']);
$clname=trim($_POST['clname']);
$sex=$_POST['sex'];
$christmas = $_POST['birthdate'];
$parts = explode('-',$christmas);
$birthdate = $parts[0] . '-' . $parts[1] . '-' . $parts[2]; 
$query3 = "INSERT INTO child (cfname, clname, dob, sex, userid) VALUES('$cfname','$clname','$birthdate','$sex','$userid')";
$sql = $db->query($query3);
$childid = mysqli_insert_id($db);  
$_SESSION['childid']=$childid;
 }
//$childid= $_SESSION['childid'];




//if add vaccines button is selected
 if ( isset( $_POST['addvaccine'] ) ) 
 {
	 $vaccname=$_POST['vname'];
	 //$dosagedate=$_POST['dosagedate'];
	 $symptom1=trim($_POST['symptom1']);
	 $symptom2=trim($_POST['symptom2']);
	 $symptom3=trim($_POST['symptom3']);
	 //changing date format to store it in the database
	 $christmas = $_POST['dosagedate'];
     $parts = explode('-',$christmas);
     $dosagedate = $parts[0] . '-' . $parts[1] . '-' . $parts[2];

 
 
 //insert it into the database
 
 //get vaccination id from vaccine table-working
$query = "SELECT vaccineid FROM vaccine WHERE vaccinename='$vaccname'";
$result=$db->query($query);  
$row = $result->fetch_array();
$vaccineid=$row[0];




//insert this info into vacc_child table-working
 $query3 = "INSERT INTO vacc_child (symptom1, symptom2, symptom3, vid, dosagedate, childid) VALUES('$symptom1','$symptom2','$symptom3','$vaccineid','$dosagedate','$childid')";
 $sql = $db->query($query3);

	 
 }
 //if delete vaccine is selected
 if ( isset( $_POST['deletevaccine'] ) ) 
 {
$vaccinename=$_POST['vaccinename'];
$dosagedate=$_POST['dosagedate'];
$symptom1=$_POST['symptom1'];
$symptom2=$_POST['symptom2'];
$symptom3=$_POST['symptom3'];

$query = "SELECT vaccineid FROM vaccine WHERE vaccinename='$vaccinename'";
$result=$db->query($query);  
$row = $result->fetch_array();
$vaccineid=$row[0];
$query3 = "DELETE FROM vacc_child WHERE vid='$vaccineid' and symptom1='$symptom1' and symptom2='$symptom2' and symptom3='$symptom3' and dosagedate='$dosagedate' and childid='$childid'";
$sql = $db->query($query3);

 }	 
 
//if modify vaccine is selected
if ( isset( $_POST['modifyvaccine'] ) ) 
 {
$vaccinename=$_POST['vaccinename'];
$dosagedate=$_POST['dosagedate'];
$symptom1=$_POST['symptom1'];
$symptom2=$_POST['symptom2'];
$symptom3=$_POST['symptom3'];

$query = "SELECT vaccineid FROM vaccine WHERE vaccinename='$vaccinename'";
$result=$db->query($query);  
$row = $result->fetch_array();
$vaccineid=$row[0];
$query = "UPDATE vacc_child SET symptom1='$symptom1' WHERE vid='$vaccineid' and dosagedate='$dosagedate' and childid='$childid' ";
$result=$db->query($query);
$query = "UPDATE vacc_child SET symptom2='$symptom2' WHERE vid='$vaccineid' and dosagedate='$dosagedate' and childid='$childid' ";
$result=$db->query($query);
$query = "UPDATE vacc_child SET symptom3='$symptom3' WHERE vid='$vaccineid' and dosagedate='$dosagedate' and childid='$childid' ";
$result=$db->query($query);
 }	 

//-------------------------------------------------------------external vaccine information--------------------------------------------------
//-------------------------------------------------------------external vaccine information--------------------------------------------------
//-------------------------------------------------------------external vaccine information--------------------------------------------------
//-------------------------------------------------------------external vaccine information--------------------------------------------------
//-------------------------------------------------------------external vaccine information--------------------------------------------------

if ( isset( $_POST['addevaccine'] ) ) 
 {
	 $vaccname=$_POST['evaccname'];
	 //$dosagedate=$_POST['dosagedate'];
	 $description=$_POST['evaccdesc'];
	 $symptom1=trim($_POST['esymptom1']);
	 $symptom2=trim($_POST['esymptom2']);
	 $symptom3=trim($_POST['esymptom3']);
	 //changing date format to store it in the database
	 $christmas = $_POST['edosagedate'];
     $parts = explode('-',$christmas);
     $dosagedate = $parts[0] . '-' . $parts[1] . '-' . $parts[2];

 
 
//insert it into the database
  $query3 = "INSERT INTO externalvacc (evaccname, evaccdesc) VALUES('$vaccname','$description')";
  $sql = $db->query($query3);
$query = "SELECT evaccid FROM externalvacc WHERE evaccname='$vaccname'";
$result=$db->query($query);  
$row = $result->fetch_array();
$vaccineid=$row[0];
	 
//get childid similarly
//for now let childid be 1
//$childid=1;

//insert this info into vacc_child table-working
 $query3 = "INSERT INTO evacc_child (symptom1, symptom2, symptom3, evid, dosagedate, childid) VALUES('$symptom1','$symptom2','$symptom3','$vaccineid','$dosagedate','$childid')";
 $sql = $db->query($query3);

	 
 }

//delete external vaccines
if ( isset( $_POST['deleteevaccine'] ) ) 
 {
$vaccinename=$_POST['evaccinename'];
$dosagedate=$_POST['edosagedate'];
$symptom1=$_POST['esymptom1'];
$symptom2=$_POST['esymptom2'];
$symptom3=$_POST['esymptom3'];

$query = "SELECT evaccid FROM externalvacc WHERE evaccname='$vaccinename'";
$result=$db->query($query);  
$row = $result->fetch_array();
$vaccineid=$row[0];
$query3 = "DELETE FROM evacc_child WHERE evid='$vaccineid' and symptom1='$symptom1' and symptom2='$symptom2' and symptom3='$symptom3' and dosagedate='$dosagedate' and childid='$childid'";
$sql = $db->query($query3);

 }	 

//if modify vaccine is selected
if ( isset( $_POST['modifyevaccine'] ) ) 
 {
$vaccinename=$_POST['evaccinename'];
$dosagedate=$_POST['edosagedate'];
$symptom1=$_POST['esymptom1'];
$symptom2=$_POST['esymptom2'];
$symptom3=$_POST['esymptom3'];

$query = "SELECT evaccid FROM externalvacc WHERE evaccname='$vaccinename'";
$result=$db->query($query);  
$row = $result->fetch_array();
$vaccineid=$row[0];
$query = "UPDATE evacc_child SET symptom1='$symptom1' WHERE evid='$vaccineid' and dosagedate='$dosagedate' and childid='$childid' ";
$result=$db->query($query);
$query = "UPDATE evacc_child SET symptom2='$symptom2' WHERE evid='$vaccineid' and dosagedate='$dosagedate' and childid='$childid' ";
$result=$db->query($query);
$query = "UPDATE evacc_child SET symptom3='$symptom3' WHERE evid='$vaccineid' and dosagedate='$dosagedate' and childid='$childid' ";
$result=$db->query($query);
 }	 



?>
  <!------ Include the above in your HEAD tag ---------->

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

				
				
				
				
  <div class="container">
    <div class="row">

      <p></p>


      <div class="col-md-10 col-md-offset-1">

        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <div class="row">
              <div class="col col-xs-6">
                <h3 class="panel-title">Compare Vaccine Symptoms</h3>
              </div>
               
            </div>
          </div>
        
            <div class="panel-body">
         </br>
		 <form method="post" action="comparesymptoms.php">
	<div class="row">
        <div class="col-sm-6 col-sm-offset-3">
            <div id="imaginary_container"> 
                <div class="input-group stylish-input-group">
				   
                    <input type="text" class="form-control" name="vname" placeholder="Search" >
                    <span class="input-group-addon">
                         <input type="submit" class="btn-danger" name="searchvaccine" value="SEARCH">
					
                    </span>
                </div>
            </div>
        </div>
	</div>
	</form>
</br>
</div>



</div>

</div></div></div>   
<!---modal for add vaccine-->             

</form>
		  
		 


  
  
  
  
 <center><p><b>Search Results</b></p> </center>
  <div class="container">
    <div class="">

      <p></p>



              <table class="table table-striped table-bordered table-list">
                <thead>
                  <tr>

                    <th>Vaccine</th>
                   
                    <th>Description</th>
                    <th>Compare</th>
                    
                  </tr> 
                </thead>
                <tbody>
<?php 
if ( isset( $_POST['searchvaccine'] ) ) 
 {
	
	 $vname=$_POST['vname'];
$query = "SELECT vaccinename, vaccineid, description FROM vaccine where vaccinename like '%".$vname."%'";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              


?>                 <tr>
                   <form method="post" action="comparesymptoms.php">
                   <td><input type="text" class="form-control" name="vaccinename" value="<?php echo $row['vaccinename']; ?>" readonly></td>
				   <td><input type="text" class="form-control" name="description" value="<?php echo $row['description']; ?>" readonly></td>
				   <input type="hidden" name="vaccineid" value="<?php echo $row['vaccineid']; ?>">
				   <td><center><input type="submit" class="btn btn-warning" name="comparevaccine" value="COMPARE"></center></td>
				
				   </form>
                 </tr>
                
<?php  }
          }
 }
            
$vname=$_POST['vname'];
$querys = "SELECT evaccname, evaccid, evaccdesc FROM externalvacc where evaccname like '%".$vname."%'";
       if($results = mysqli_query($db, $querys)){
        if(mysqli_num_rows($results) > 0){
      
          while($rows = mysqli_fetch_array($results))
          {
              


?>                 <tr>
                   <form method="post" action="comparesymptoms.php">
                   <td><input type="text" class="form-control" name="vaccinename" value="<?php echo $rows['evaccname']; ?>" readonly></td>
				   <td><input type="text" class="form-control" name="description" value="<?php echo $rows['evaccdesc']; ?>" readonly></td>
				   <input type="hidden" name="vaccineid" value="<?php echo $rows['evaccid']; ?>">
				   <td><center><input type="submit" class="btn btn-warning" name="compareevaccine" value="COMPARE"></center></td>
				
				   </form>
                 </tr>
                
<?php  }
          }
 }}
        ?>    




		
           
 
</tbody>
</table>
</div>
</div>


<!-- displaying comparision results -->  
 <center><p><b>Comparision Results</b></p> </center>
  <div class="container">
    <div class="">

      <p></p>



              <table class="table table-striped table-bordered table-list">
                <thead>
                  <tr>

                    <th>Child Name</th>
                    <th>Vaccine</th>
                    <th>Symptom1</th>
                    <th>Symptom2</th>
                    <th>Symptom3</th>
                 
                    
                  </tr> 
                </thead>
                <tbody>
<?php 
if ( isset( $_POST['comparevaccine'] ) ) 
 {
	
	$vaccinename=$_POST['vaccinename'];
	$vaccineid=$_POST['vaccineid'];
	
$query = "SELECT C.cfname as cfname, V.vaccinename as vaccinename, VC.symptom1 as symptom1, VC.symptom2 as symptom2, VC.symptom3 as symptom3 FROM vaccine V,child C, vacc_child VC where C.childid=VC.childid and C.userid='$userid' and V.vaccineid=VC.vid  and V.vaccinename='$vaccinename'";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              


?>                 <tr>
                 
                   <td><?php echo $row['cfname']; ?></td>
				   <td><?php echo $row['vaccinename']; ?></td>
				   <td><?php echo $row['symptom1']; ?></td>
				   <td><?php echo $row['symptom2']; ?></td>
				   <td><?php echo $row['symptom3']; ?></td>
				  
				
		
				   
				   
				   
				   
                 </tr>
                
<?php  }
          }
 } ?>
 <tr>
  <td><?php echo "Common Symptoms" ?></td>
				   <td><?php echo $vaccinename; ?></td>
<?php				   
$vaccinename=$_POST['vaccinename'];
//$query = "SELECT  V.vaccinename, A.symptom1 as symptom1, B.symptom1 as symptom2, C.symptom1 as symptom3 FROM vaccine V, vacc_child A,vacc_child B,vacc_child C  WHERE V.vaccinename='$vaccinename' and A.symptom1=B.symptom2 and B.symptom2=C.symptom3 and V.vaccineid=A.vid";
$query ="select symptom
         from(
         select symptom1 as symptom, vaccineid from vacc_child, vaccine where vaccineid=vid and vaccinename='$vaccinename'
         union all
		 select symptom2 as symptom,vaccineid from vacc_child, vaccine where vaccineid=vid and vaccinename='$vaccinename'
		 union all
		 select symptom3 as symptom, vaccineid from vacc_child, vaccine where vaccineid=vid and vaccinename='$vaccinename')t
		 GROUP BY symptom
         ORDER BY COUNT(*) DESC
		 LIMIT 3";
 

if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {?>
             <td><?php echo $row['symptom']; ?></td>
			
		<?php  }
		}
}

 ?>
	   
				   
                 </tr>
 
 <?php
 }
 ?>
<?php 
if ( isset( $_POST['compareevaccine'] ) ) 
 {
	
	$vaccinename=$_POST['vaccinename'];
	$vaccineid=$_POST['vaccineid'];
	
$query = "SELECT C.cfname as cfname, V.evaccname as vaccinename, VC.symptom1 as symptom1, VC.symptom2 as symptom2, VC.symptom3 as symptom3 FROM externalvacc V,child C, evacc_child VC where C.childid=VC.childid and C.userid='$userid' and V.evaccid=VC.evid  and V.evaccname='$vaccinename'";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              


?>                 <tr>
                 
                   <td><?php echo $row['cfname']; ?></td>
				   <td><?php echo $row['vaccinename']; ?></td>
				   <td><?php echo $row['symptom1']; ?></td>
				   <td><?php echo $row['symptom2']; ?></td>
				   <td><?php echo $row['symptom3']; ?></td>
				  
				
		
				   
				   
				   
				   
                 </tr>
                
<?php  }
          }
 } ?>
 <tr>
  <td><?php echo "Common Symptoms" ?></td>
				   <td><?php echo $vaccinename; ?></td>
<?php				   
$vaccinename=$_POST['vaccinename'];
//$query = "SELECT  V.vaccinename, A.symptom1 as symptom1, B.symptom1 as symptom2, C.symptom1 as symptom3 FROM vaccine V, vacc_child A,vacc_child B,vacc_child C  WHERE V.vaccinename='$vaccinename' and A.symptom1=B.symptom2 and B.symptom2=C.symptom3 and V.vaccineid=A.vid";
$query ="select symptom
         from(
         select symptom1 as symptom, evaccid from evacc_child, externalvacc where evaccid=evid and evaccname='$vaccinename'
         union all
		 select symptom2 as symptom,evaccid from evacc_child, externalvacc where evaccid=evid and evaccname='$vaccinename'
		 union all
		 select symptom3 as symptom, evaccid from evacc_child, externalvacc where evaccid=evid and evaccname='$vaccinename')t
		 GROUP BY symptom
         ORDER BY COUNT(*) DESC
		 LIMIT 3";
 

if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {?>
             <td><?php echo $row['symptom']; ?></td>
			
		<?php  }
		}
}

 ?>
	   
				   
                 </tr>
 
 <?php
 }
 ?> 
            
 




		
           
 
</tbody>
</table>
</div>
</div>

<!------------------------------------PRINT THE PAGE---------------------------------------------------------------->



<center>
                                    <div class="col-sm-12 controls">
                                      <button class="btn btn-primary hidden-print" onclick="myFunction()"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
                                     

                                    </div>
									</center>
                            






</body>
</html>