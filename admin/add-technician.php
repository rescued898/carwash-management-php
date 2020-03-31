<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{
// Code for change password	
if(isset($_POST['submit']))
{
$tec_name=$_POST['tec_name'];
$tec_contact=$_POST['tec_contact'];
$tec_email=$_POST['tec_email'];
$tec_address=$_POST['tec_address'];
$sql="INSERT INTO  tbltecnician(tec_name,tec_contact,tec_email,tec_address) VALUES(:tec_name,:tec_contact,:tec_email,:tec_address)";
$query = $dbh->prepare($sql);
$query->bindParam(':tec_name',$tec_name,PDO::PARAM_STR);
$query->bindParam(':tec_contact',$tec_contact,PDO::PARAM_STR);
$query->bindParam(':tec_email',$tec_email,PDO::PARAM_STR);
$query->bindParam(':tec_address',$tec_address,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Technician add successfully";
}
else 
{
$error="Something went wrong. Please try again";
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
	
	<title>Car Wash Portal | Admin Add Technician</title>

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
					
						<h2 class="page-title">Add Technician</h2>

						<div class="row">
							<div class="col-md-10">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
										<form method="post" name="chngpwd" class="form-horizontal" onSubmit="return valid();">
										
											
  	        	  <?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

											<div class="form-group">
												<label class="col-sm-4 control-label">Technician Name</label>
												<div class="col-sm-8">
													<input type="text" class="form-control" name="tec_name" id="tec_name" required>
												</div>

												<label class="col-sm-4 control-label">Contact</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"  name="tec_contact" id="tec_contact" required>
												</div>

												<label class="col-sm-4 control-label">Email</label>
												<div class="col-sm-8">
													<input type="text" class="form-control"  name="tec_email" id="tec_email" required>
												</div>

												<label class="col-sm-4 control-label">Address</label>
												<div class="col-sm-8">
													<textarea class="form-control" name="tec_address" rows="3" required></textarea>
												</div>


											</div>
											<div class="hr-dashed"></div>
											
										
								
											
											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-4">
								
													<button class="btn btn-primary" name="submit" type="submit">Submit</button>
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