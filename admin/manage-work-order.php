<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
if(isset($_REQUEST['eid']))
	{
$eid=intval($_GET['eid']);
$status="2";
$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:eid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':eid',$eid, PDO::PARAM_STR);
$query -> execute();

$msg="Booking Successfully Cancelled";
}


if(isset($_REQUEST['aeid']))
	{
$aeid=intval($_GET['aeid']);
$status=1;

$sql = "UPDATE tblbooking SET Status=:status WHERE  id=:aeid";
$query = $dbh->prepare($sql);
$query -> bindParam(':status',$status, PDO::PARAM_STR);
$query-> bindParam(':aeid',$aeid, PDO::PARAM_STR);
$query -> execute();

$msg="Booking Successfully Confirmed";
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
	
	<title>Car Wash Portal |Admin Manage Work Order   </title>

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

						<h2 class="page-title">Manage Work Order</h2>

						<!-- Zero Configuration Table -->
						<div class="panel panel-default">
							<div class="panel-heading">Work Order Info</div>
							<div class="panel-body">
							<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
								<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
									<thead>
										<tr>
										<th>#</th>
											<th>Customer Name</th>
											<th>Invoice</th>
											<th>Contact No</th>
											<th>Package Name</th>
											<th>Additional Parts</th>
											<th>Technician Name</th>
											<th>Appointment Date</th>
											<th>Assigned Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tfoot>
										<tr>
										<th>#</th>
											<th>Customer Name</th>
											<th>Invoice</th>
											<th>Contact No</th>
											<th>Package Name</th>
											<th>Additional Parts</th>
											<th>Technician Name</th>
											<th>Appointment Date</th>
											<th>Assigned Date</th>
											<th>Status</th>
											<th>Action</th>
										</tr>
									</tfoot>
									<tbody>

									<?php $sql = "SELECT tblusers.FullName,tblpackage.packagetitle,tblbooking.bookingdate,tblbooking.timeslot,tblbooking.message,tblbooking.packageid as pid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.invoice_number,tblbooking.payment_opt,tblusers.EmailId,tblusers.ContactNo, tblwork_order.product_id,tblwork_order.technician_id,tblwork_order.order_status,tblwork_order.assign_date,tbltecnician.tec_name,tbltecnician.tec_contact  from tblbooking join tblpackage on tblpackage.id=tblbooking.packageid join tblusers on tblusers.EmailId=tblbooking.userEmail join tblwork_order on tblwork_order.invoice_no=tblbooking.invoice_number join tbltecnician on tbltecnician.id=tblwork_order.technician_id ORDER BY tblwork_order.id DESC";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{				?>	
										<tr>
											<td><?php echo htmlentities($cnt);?></td>
											<td><?php echo htmlentities($result->FullName);?></td>
											<td><?php echo htmlentities($result->invoice_number);?></td>
											<td><?php echo htmlentities($result->ContactNo);?></td>
											<td><a href="edit-package.php?id=<?php echo htmlentities($result->pid);?>"><?php echo htmlentities($result->packagetitle);?></td>
											<td><?php echo htmlentities($result->assign_date);?></td>
											
											<td><?php echo htmlentities($result->tec_name);?></td>
											<td><?php echo htmlentities($result->bookingdate);?></td>
											<td><?php echo htmlentities($result->assign_date);?></td>
											<!-- <td><?php 
$invoice_no=$result->invoice_number;
$sql1 = "SELECT * from tblpayments where invoice_no=:invoice_no";
$query1 = $dbh -> prepare($sql1);
$query1 -> bindParam(':invoice_no',$invoice_no, PDO::PARAM_STR);
$query1->execute();
if($query1->rowCount() > 0)
  {  
    
     echo htmlentities('Paid');
  }elseif($result->payment_opt=='cash') 
     {
     	echo htmlentities('In Cash');
     }
  else{
     echo htmlentities('Due');
  }                     
   
                    
   ?>
									        </td> -->

											<td><?php 
if($result->Status==0)
{
echo htmlentities('Not Confirmed yet');
} else if ($result->Status==1) {
echo htmlentities('Confirmed');
}
 else{
 	echo htmlentities('Cancelled');
 }
										?></td>

										<td><a href="view-work-order.php?bid=<?php echo htmlentities($result->id);?>">View</a> /

					


<a href="manage-bookings.php?eid=<?php echo htmlentities($result->id);?>" onclick="return confirm('Do you really want to Cancel this Booking')"> Cancel</a>
</td>

										</tr>
										<?php $cnt=$cnt+1; }} ?>
										
									</tbody>
								</table>

						

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
