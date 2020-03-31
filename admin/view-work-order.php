<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

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
	
	<title>Car Wash Portal | Admin View Work Order Info</title>

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
					
						<h2 class="page-title">View Work Order</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php 
$bid=intval($_GET['bid']);

$sql ="SELECT tblusers.FullName,tblpackage.packagetitle,tblbooking.bookingdate,tblbooking.timeslot,tblbooking.message,tblusers.Address,tblbooking.totalprice, tblbooking.packageid as pid,tblbooking.Status,tblbooking.PostingDate,tblbooking.id,tblbooking.service,tblbooking.cartype, tblbooking.invoice_number,tblbooking.payment_opt,tblusers.EmailId,tblusers.ContactNo, tblwork_order.product_id,tblwork_order.technician_id,tblwork_order.order_status,tblwork_order.assign_date,tbltecnician.tec_name,tbltecnician.tec_contact  from tblbooking join tblpackage on tblpackage.id=tblbooking.packageid join tblusers on tblusers.EmailId=tblbooking.userEmail join tblwork_order on tblwork_order.invoice_no=tblbooking.invoice_number join tbltecnician on tbltecnician.id=tblwork_order.technician_id where tblbooking.id=:bid";
$query = $dbh -> prepare($sql);
$query-> bindParam(':bid', $bid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>




<table class="table table-bordered">
  <tbody>
   <tr>
    <td class="col-md-6">Invoice</td>
    <td class="col-md-6">
     <?php echo htmlentities($result->invoice_number);?>
    </td>
   </tr>
   <tr>
    <td>Customer Name</td>
    <td style="color: green; font-weight: bolder;">
     <?php echo htmlentities($result->FullName);?>
    </td>
   </tr>
   <tr>
    <td>Customer Email</td>
    <td>
     <?php echo htmlentities($result->EmailId);?>
    </td>
   </tr>
   <tr>
    <td>Customer Contact</td>
    <td style="color: green; font-weight: bolder;">
     <?php echo htmlentities($result->ContactNo);?>
    </td>
   </tr>
   <tr>
    <td>Customer Address</td>
    <td>
     <?php echo htmlentities($result->Address);?>
    </td>
   </tr>
   <tr>
    <td>Package Name</td>
    <td>
     <?php echo htmlentities($result->packagetitle);?>
    </td>
   </tr>
   <tr>
    <td>Service Type</td>
    <td style="color: green; font-weight: bolder;">
     <?php echo htmlentities($result->service);?>
    </td>
   </tr>
   <tr>
    <td>Vehicle Type</td>
    <td style="color: green; font-weight: bolder;">
     <?php echo htmlentities($result->cartype);?>
    </td>
   </tr>
   <tr>
    <td>Addition Parts</td>
    <td>
     <?php echo htmlentities($result->invoice_number);?>
    </td>
   </tr>
   <tr>
    <td>Technician Name</td>
    <td style="color: green; font-weight: bolder;">
     <?php echo htmlentities($result->tec_name);?>
    </td>
   </tr>
   <tr>
    <td>Appointment Date</td>
    <td>
     <?php echo htmlentities($result->bookingdate);?>
    </td>
   </tr>
   <tr>
    <td>Appointment Time Slot</td>
    <td>
     <?php echo htmlentities($result->timeslot);?>
    </td>
   </tr>
   <tr>
    <td>Assigned Date</td>
    <td>
     <?php echo htmlentities($result->assign_date);?>
    </td>
   </tr>
   <tr>
    <td>Total Package Cost(including all charges)</td>
    <td style="color: green; font-weight: bolder;">
     <?php echo htmlentities($result->totalprice);?>
    </td>
   </tr>
   <tr>
    <td>Additional Cost</td>
    <td>
     <?php echo htmlentities($result->invoice_number);?>
    </td>
   </tr>
   <tr>
    <td>Payment Status</td>
    <td style="color: green; font-weight: bolder;">
     <?php 

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
    </td>
   </tr>
   
   <tr>
    <td>Customer Sign</td>
    <td></td>
   </tr>
   <tr>
    <td>Technician Sign</td>
    <td></td>
   </tr>
  </tbody>
 </table>
 <div class="">
  <form class='d-print-none d-inline mr-3'><input class='btn btn-danger' type='submit' value='Print' onClick='window.print()'></form>
  <form class='d-print-none d-inline' action="manage-work-order.php"><input class='btn btn-secondary' type='submit' value='Close'></form>
 </div>










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
<?php } } } ?>