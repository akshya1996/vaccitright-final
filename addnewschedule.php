<?php
session_start(); 
$db = new mysqli("localhost","root","","vaccitright");
$userid=$_SESSION['userid'];
if ( isset( $_POST['viewedit'] ) ) 
 {
	 $_SESSION['childid']=$_POST['dfchildid'];
	
 }

//$childid=$_SESSION['childid'];


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
$childid= $_SESSION['childid'];




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
<div class="fright mr10">
<form class="form-horizontal" role="form" action="addnewschedule.php" method="post">
					
					</a>
					<input type="hidden" name="childid" class="form-control" value="<?php echo $childid; ?>">
					<input data-toggle="modal" href="#deletemodal" data-scroll class="btn btn-danger" name="deletechild" value="Delete Schedule" readonly>
</form>
				</div><br><br><br>
				<hr>
				
				
				
<div class="modal fade" id="deletemodal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Confirmation Message</b></h4>
        </div>
        <div class="modal-body">
		<form class="form-horizontal" role="form" action="addnewschedule.php" method="post">
          <p>Are you sure to delete the schedule</p>
        
        </div>
        <div class="modal-footer">
		  <input type="submit" class="btn btn-danger" name="deletechild" value="Delete Schedule">
		  </form>
        </div>
      </div>
      
    </div>
  </div>				
  <div class="container">
    <div class="row">

      <p></p>


      <div class="col-md-10 col-md-offset-1">

        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <div class="row">
              <div class="col col-xs-6">
                <h3 class="panel-title">Create Schedule to add common Vaccines</h3>
              </div>

            </div>
          </div>
          <form id="loginform" class="form-horizontal" role="form">
            <div class="panel-body">
          
</div>
<center>
<div style="margin-top:10px" class="form-group">
  <!-- Button -->

    <div class="col-sm-12 controls">

      <a id="creates" class="btn btn-success" data-toggle="modal" href="#addvaccModal" data-scroll>Add vaccines</a>


   

    </div>

</div>
</center>

</form>
</div>

</div></div></div>   
<!---modal for add vaccine-->             
<div class="modal fade" id="addvaccModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Add Vaccine</b></h4>
        </div>
        <div class="modal-body">
         <form name="form1" method="post" action="addnewschedule.php">
<center>
<p>Use this form to add common vaccines</p>
      <table class="table table-striped table-bordered table-list">
        <tr>
          <td id="lefttd">Vaccine Name:</td>
           <td>
            <select name="vname" class="">
             <option value="DTaP" selected>DTap</option>
             <option value="HepA">HepA</option>
             <option value="HepB">HepB</option>
			 <option value="Hib">Hib</option>
			 <option value="IPV">IPV</option>
			 <option value="MMR">MMR</option>
			 <option value="PCV">PCV</option>
			 <option value="Rota">Rota</option>
			 <option value="VAR">VAR</option>
           </select>
         </td>
        </tr>
		</br>
        <tr>
          <td>Dosage Month:</td>
          <td><input type="date" name="dosagedate" required/></td>
        </tr>
		</br>
        <tr>
          <td>Symptom 1</td>
          <td><input type="text" name="symptom1" /></td>
        </tr>
        <tr>
          <td>Symptom 2</td>
          <td><input type="text" name="symptom2"/></td>
        </tr>
        <tr>
          <td>Symptom 3</td>
          <td><input type="text" name="symptom3"/></td>
        </tr>
       
       
       
      </table>
  
     
    
        <input type="submit" class="btn btn-success" name="addvaccine" value="ADD VACCINE INFORMATION"></td><br><br>
    
   
 
  </center>
</form>
		  
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> 
  

  
  
  
  
 <center><p><b>Common Vaccine Information</b></p> </center>
  <div class="container">
    <div class="">

      <p></p>



              <table class="table table-striped table-bordered table-list">
                <thead>
                  <tr>

                    <th>Vaccine</th>
                   
                    <th>Dosage month</th>
                    <th>Symptom1</th>
                    <th>Symptom2</th>
                    <th>Symptom3</th>
					<th>Delete</th>
					<th>Modify</th>
                  </tr> 
                </thead>
                <tbody>
<?php 

$query = "SELECT vaccinename,description,dosagedate,symptom1,symptom2,symptom3 FROM vaccine,vacc_child where childid='$childid' and vaccineid=vid";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              


?>                 <tr>
                   <form method="post" action="addnewschedule.php">
                   <td><input type="text" name="vaccinename" value="<?php echo $row['vaccinename']; ?>" readonly></td>
                   <td><input type="text" name="dosagedate" value="<?php echo $row['dosagedate'];?>" readonly></td>
                   <td><input type="text" name="symptom1" value="<?php echo $row['symptom1'];?>"></td>
                   <td><input type="text" name="symptom2" value="<?php echo $row['symptom2'];?>"></td>
				   <td><input type="text" name="symptom3" value="<?php echo $row['symptom3'];?>"></td>
				   <td><input type="submit" class="btn btn-danger" name="deletevaccine" value="DELETE"></td>
				   <td><input type="submit" class="btn btn-warning" name="modifyvaccine" value="MODIFY"></td>
				   </form>
                 </tr>
                
<?php  }
          }
        }
        ?>             
           
 
</tbody>
</table>
<hr>

<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->
<!----------------------------------------------------------EXTERNAL VACCINE INFORMATION---------------------------------------------------->


  <div class="container">
    <div class="row">

      <p></p>


      <div class="col-md-10 col-md-offset-1">

        <div class="panel panel-default panel-table">
          <div class="panel-heading">
            <div class="row">
              <div class="col col-xs-6">
                <h3 class="panel-title">Create Schedule to Add External Vaccines</h3>
              </div>

            </div>
          </div>
          <form id="loginform" class="form-horizontal" role="form">
            <div class="panel-body">
          
</div>
<center>
<div style="margin-top:10px" class="form-group">
  <!-- Button -->

    <div class="col-sm-12 controls">

      <a id="creates" class="btn btn-primary" data-toggle="modal" href="#addevaccModal" data-scroll>Add vaccine</a>


   

    </div>

</div>
</center>

</form>
</div>

</div></div></div>   
<!---modal for add vaccine-->             
<div class="modal fade" id="addevaccModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><b>Add External Vaccine</b></h4>
        </div>
        <div class="modal-body">
         <form name="form1" method="post" action="addnewschedule.php">
<center>
<p>Use this form to add external vaccines</p>
      <table class="table table-striped table-bordered table-list">
        <tr>
          <td id="lefttd">Vaccine Name:</td>
           
            <td><input type="text" name="evaccname" required/></td>
       
        </tr>
		</br>
		<tr>
          <td id="lefttd">Description:</td>
           
            <td><input type="text" name="evaccdesc" required/></td>
       
        </tr>
		</br>
        <tr>
          <td>Dosage Month:</td>
          <td><input type="date" name="edosagedate" required/></td>
        </tr>
		</br>
        <tr>
          <td>Symptom 1</td>
          <td><input type="text" name="esymptom1" /></td>
        </tr>
        <tr>
          <td>Symptom 2</td>
          <td><input type="text" name="esymptom2"/></td>
        </tr>
        <tr>
          <td>Symptom 3</td>
          <td><input type="text" name="esymptom3"/></td>
        </tr>
       
       
       
      </table>
  
     
    
        <input type="submit" class="btn btn-success" name="addevaccine" value="ADD VACCINE INFORMATION"></td><br><br>
    
   
 
  </center>
</form>
		  
		 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div> 
  

  
  
  
  
 <center><p><b>External Vaccine Information</b></p> </center>
  <div class="container">
    <div class="">

      <p></p>



              <table class="table table-striped table-bordered table-list">
                <thead>
                  <tr>

                    <th>Vaccine</th>
                   
                    <th>Dosage month</th>
                    <th>Symptom1</th>
                    <th>Symptom2</th>
                    <th>Symptom3</th>
					<th>Delete</th>
					<th>Modify</th>
                  </tr> 
                </thead>
                <tbody>
<?php 

$query = "SELECT evaccname,evaccdesc,dosagedate,symptom1,symptom2,symptom3 FROM externalvacc,evacc_child where childid='$childid' and evaccid=evid";
       if($result = mysqli_query($db, $query)){
        if(mysqli_num_rows($result) > 0){
      
          while($row = mysqli_fetch_array($result))
          {
              


?>                 <tr>
                   <form method="post" action="addnewschedule.php">
                   <td><input type="text" name="evaccinename" value="<?php echo $row['evaccname']; ?>" readonly></td>
				   
                   <td><input type="text" name="edosagedate" value="<?php echo $row['dosagedate'];?>" readonly></td>
                   <td><input type="text" name="esymptom1" value="<?php echo $row['symptom1'];?>"></td>
                   <td><input type="text" name="esymptom2" value="<?php echo $row['symptom2'];?>"></td>
				   <td><input type="text" name="esymptom3" value="<?php echo $row['symptom3'];?>"></td>
				   <td><input type="submit" class="btn btn-danger" name="deleteevaccine" value="DELETE"></td>
				   <td><input type="submit" class="btn btn-warning" name="modifyevaccine" value="MODIFY"></td>
				   </form>
                 </tr>
                
<?php  }
          }
        }
        ?>             
           
 
</tbody>
</table>



<!------------------------------------PRINT THE PAGE---------------------------------------------------------------->


 <form method="post" action="printschedule.php">
<center>
                                    <div class="col-sm-12 controls">
                                      <button class="btn btn-primary hidden-print"><span class="glyphicon glyphicon-print" aria-hidden="true"></span> Print</button>
                                     

                                    </div>
									</center>
                            
</form>





</body>
</html>