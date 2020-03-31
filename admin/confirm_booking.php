<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{

if(isset($_POST['confirm']))
{
$Technician_id=$_POST['Technician_id'];
$booking_id=intval($_GET['aeid']);

$sql1 = "SELECT tblusers.FullName,tblpackage.packagetitle,tblbooking.bookingdate,tblbooking.timeslot,tblbooking.message,tblbooking.packageid as pid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.invoice_number,tblbooking.payment_opt,tblusers.EmailId  from tblbooking join tblpackage on tblpackage.id=tblbooking.packageid join tblusers on tblusers.EmailId=tblbooking.userEmail where tblbooking.id=:booking_id";
$query1 = $dbh -> prepare($sql1);
$query1->bindParam(':booking_id',$booking_id,PDO::PARAM_STR);
$query1->execute();
$results=$query1->fetchAll(PDO::FETCH_OBJ);
$status=0;
foreach($results as $result)
{
$invoice_number=$result->invoice_number;
$EmailId=$result->EmailId;
$bookingdate=$result->bookingdate;
$timeslot=$result->timeslot;
$pid=$result->pid;
}

// 
$sql2 = "SELECT * from tblwork_order where technician_id=:Technician_id and appointment_date=:bookingdate and appointment_time=:timeslot";
$query2 = $dbh -> prepare($sql2);
$query2->bindParam(':Technician_id',$Technician_id,PDO::PARAM_STR);
$query2->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
$query2->bindParam(':timeslot',$timeslot,PDO::PARAM_STR);
$query2->execute();
$tec_service=$query2->rowCount();
if($tec_service>1)
  {
  	echo "<script>alert('This Technician Already Booked!');</script>";
  }
  else{

$sql="INSERT INTO  tblwork_order(invoice_no,customer_email,technician_id,package_id,appointment_date,appointment_time,order_status) VALUES(:invoice_number,:EmailId,:Technician_id,:pid,:bookingdate,:timeslot,:status)";
$query = $dbh->prepare($sql);
$query->bindParam(':invoice_number',$invoice_number,PDO::PARAM_STR);
$query->bindParam(':EmailId',$EmailId,PDO::PARAM_STR);
$query->bindParam(':Technician_id',$Technician_id,PDO::PARAM_STR);
$query->bindParam(':pid',$pid,PDO::PARAM_STR);
$query->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
$query->bindParam(':timeslot',$timeslot,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Booking confirm successfull. Thank you');</script>";
echo "<script type='text/javascript'> document.location = './manage-bookings.php?aeid=$booking_id'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}
}
?>

<!doctype html>
<html lang="en" class="no-js">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<meta name="theme-color" content="#3e454c">
	
	<title>Car Wash Portal | Assign Work Order</title>

	<!-- Font awesome -->
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<!-- Sandstone Bootstrap CSS -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap Datatables -->
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<!-- Bootstrap social button library -->
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<!-- Bootstrap select -->
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<!-- Bootstrap file input -->
	<link rel="stylesheet" href="css/fileinput.min.css">
	<!-- Awesome Bootstrap checkbox -->
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<!-- Admin Stye -->
	<link rel="stylesheet" href="css/style.css">
  <style>
		.errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
		</style>


</head>

<body>
	<?php include('includes/header.php');?>
	<div class="ts-main-content">
	<?php include('includes/leftbar.php');?>
		<div class="content-wrapper">
			<div class="container-fluid">

				<div class="row">
					<div class="col-md-12">
					
						<h2 class="page-title">Assign Work Order Request</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Assign Work Order Request Details</div>
									<div class="panel-body">
									 <form method="post" class="form-horizontal" enctype="multipart/form-data">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



<div class="form-group">
									<label class="col-sm-4 control-label">Select Technician<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="Technician_id" required>
<option value=""> Select </option>
<?php $ret="select id,tec_name from tbltecnician";
$query= $dbh -> prepare($ret);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() > 0)
{
foreach($results as $result)
{
?>
<option value="<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->tec_name);?></option>
<?php }} ?>

</select>
</div>
                </div>


                <div class="form-group">
                  <input type="submit" name="confirm" value="Confirm" class="btn btn-block">
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

	<!-- Loading Scripts -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap-select.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
	<script src="js/dataTables.bootstrap.min.js"></script>
	<script src="js/Chart.min.js"></script>
	<script src="js/fileinput.js"></script>
	<script src="js/chartData.js"></script>
	<script src="js/main.js"></script>

</body>

</html>
<?php } ?>