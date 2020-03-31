<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
	{	
header('location:index.php');
}
else{ 

if(isset($_POST['submit']))
  {
$packagetitle=$_POST['packagetitle'];
$servicequality=$_POST['servicequality'];
$packageoverview=$_POST['packageoverview'];
$car_price=$_POST['car_price'];
$truck_price=$_POST['truck_price'];
$bus_price=$_POST['bus_price'];
$requiredtime=$_POST['requiredtime'];
$servicetype=$_POST['servicetype'];
$image1=$_FILES["img1"]["name"];
$image2=$_FILES["img2"]["name"];
$image3=$_FILES["img3"]["name"];
$image4=$_FILES["img4"]["name"];
$image5=$_FILES["img5"]["name"];
$CompleteCarExteriorCleaning=$_POST['CompleteCarExteriorCleaning'];
$Exterirorcarwash=$_POST['Exterirorcarwash'];
$Ecoglassclean=$_POST['Ecoglassclean'];
$Wheelclean=$_POST['Wheelclean'];
$Cleanfrontgrill=$_POST['Cleanfrontgrill'];
$CleanTire=$_POST['CleanTire'];
$Completeinteriorvaccuming=$_POST['Completeinteriorvaccuming'];
$LeatherTreated=$_POST['LeatherTreated'];
$TiresShined=$_POST['TiresShined'];
move_uploaded_file($_FILES["img1"]["tmp_name"],"img/carwashimage/".$_FILES["img1"]["name"]);
move_uploaded_file($_FILES["img2"]["tmp_name"],"img/carwashimage/".$_FILES["img2"]["name"]);
move_uploaded_file($_FILES["img3"]["tmp_name"],"img/carwashimage/".$_FILES["img3"]["name"]);
move_uploaded_file($_FILES["img4"]["tmp_name"],"img/carwashimage/".$_FILES["img4"]["name"]);
move_uploaded_file($_FILES["img5"]["tmp_name"],"img/carwashimage/".$_FILES["img5"]["name"]);

$sql="INSERT INTO tblpackage(packagetitle,service_type,service_quality,requiredtime,image1,image2,image3,image4,image5,TiresShined,packageoverview,CompleteCarExteriorCleaning,Exterirorcarwash,Ecoglassclean,Wheelclean,Cleanfrontgrill,CleanTire,Completeinteriorvaccuming,LeatherTreated,price1,price2,price3) VALUES(:packagetitle,:servicetype,:servicequality,:requiredtime,:image1,:image2,:image3,:image4,:image5,:TiresShined,:packageoverview,:CompleteCarExteriorCleaning,:Exterirorcarwash,:Ecoglassclean,:Wheelclean,:Cleanfrontgrill,:CleanTire,:Completeinteriorvaccuming,:LeatherTreated,:car_price,:truck_price,:bus_price)";
$query = $dbh->prepare($sql);
$query->bindParam(':packagetitle',$packagetitle,PDO::PARAM_STR);
$query->bindParam(':servicetype',$servicetype,PDO::PARAM_STR);
$query->bindParam(':servicequality',$servicequality,PDO::PARAM_STR);
$query->bindParam(':requiredtime',$requiredtime,PDO::PARAM_STR);
$query->bindParam(':image1',$image1,PDO::PARAM_STR);
$query->bindParam(':image2',$image2,PDO::PARAM_STR);
$query->bindParam(':image3',$image3,PDO::PARAM_STR);
$query->bindParam(':image4',$image4,PDO::PARAM_STR);
$query->bindParam(':image5',$image5,PDO::PARAM_STR);
$query->bindParam(':TiresShined',$TiresShined,PDO::PARAM_STR);
$query->bindParam(':packageoverview',$packageoverview,PDO::PARAM_STR);
$query->bindParam(':CompleteCarExteriorCleaning',$CompleteCarExteriorCleaning,PDO::PARAM_STR);
$query->bindParam(':Exterirorcarwash',$Exterirorcarwash,PDO::PARAM_STR);
$query->bindParam(':Ecoglassclean',$Ecoglassclean,PDO::PARAM_STR);
$query->bindParam(':Wheelclean',$Wheelclean,PDO::PARAM_STR);
$query->bindParam(':Cleanfrontgrill',$Cleanfrontgrill,PDO::PARAM_STR);
$query->bindParam(':CleanTire',$CleanTire,PDO::PARAM_STR);
$query->bindParam(':Completeinteriorvaccuming',$Completeinteriorvaccuming,PDO::PARAM_STR);
$query->bindParam(':LeatherTreated',$LeatherTreated,PDO::PARAM_STR);
$query->bindParam(':car_price',$car_price,PDO::PARAM_STR);
$query->bindParam(':truck_price',$truck_price,PDO::PARAM_STR);
$query->bindParam(':bus_price',$bus_price,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
$msg="Vehicle posted successfully";
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
	
	<title>Car Wash Portal | Admin Post Packages</title>

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
					
						<h2 class="page-title">Post A Package</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
<?php if($error){?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } 
				else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>

									<div class="panel-body">
<form method="post" class="form-horizontal" enctype="multipart/form-data">

<div class="form-group">
<label class="col-sm-2 control-label">Package Title<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="packagetitle" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Select Service Quality<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="servicequality" required>
<option value=""> Select </option>
<option value="CLASSIC">CLASSIC </option>
<option value="PREMIUM">PREMIUM </option>
<option value="PREMIUMPLUS">PREMIUM PLUS </option>
</select>
</div>
</div>
											


<div class="hr-dashed"></div>
<div class="form-group">
<label class="col-sm-2 control-label">Package Overview<span style="color:red">*</span></label>
<div class="col-sm-10">
<textarea class="form-control" name="packageoverview" rows="3" required></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Price Per Vehicle<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="text" name="car_price" class="form-control" placeholder="Car" required>
</div>
<div class="col-sm-2">
<input type="text" name="truck_price" class="form-control" placeholder="Truck" required>
</div>
<div class="col-sm-2">
<input type="text" name="bus_price" class="form-control" placeholder="Bus" required>
</div>
</div>



<div class="form-group">
<label class="col-sm-2 control-label">Required Time<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="requiredtime" class="form-control" required>
</div>
<label class="col-sm-2 control-label">Select Service Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="servicetype" required>
<option value=""> Select </option>

<option value="WATER">WATER WASH</option>
<option value="WATERLESS">WATERLESS WASH</option>
<option value="WAX">WASH AND WAX</option>
</select>
</div>
</div>
</div>
<div class="hr-dashed"></div>


<div class="form-group">
<div class="col-sm-12">
<h4><b>Upload Images</b></h4>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 1 <span style="color:red">*</span><input type="file" name="img1" required>
</div>
<div class="col-sm-4">
Image 2<span style="color:red">*</span><input type="file" name="img2" required>
</div>
<div class="col-sm-4">
Image 3<span style="color:red">*</span><input type="file" name="img3" required>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<span style="color:red">*</span><input type="file" name="img4" required>
</div>
<div class="col-sm-4">
Image 5<input type="file" name="img5">
</div>

</div>
<div class="hr-dashed"></div>									
</div>
</div>
</div>
</div>
							

<div class="row">
<div class="col-md-12">
<div class="panel panel-default">
<div class="panel-heading">Accessories</div>
<div class="panel-body">


<div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="CompleteCarExteriorCleaning" name="CompleteCarExteriorCleaning" value="1">
<label for="CompleteCarExteriorCleaning"> Complete Car Exterior Cleaning </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Exterirorcarwash" name="Exterirorcarwash" value="1">
<label for="Exterirorcarwash"> Exteriror carwash </label>
</div></div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Ecoglassclean" name="Ecoglassclean" value="1">
<label for="Ecoglassclean"> Ecoglass clean & gloss </label>
</div></div>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Wheelclean" name="Wheelclean" value="1">
<label for="Wheelclean"> Wheel clean & finish </label>
</div>
</div>



<div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Cleanfrontgrill" name="Cleanfrontgrill" value="1">
<label for="Cleanfrontgrill"> Clean frontgrill & mudflaps </label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="CleanTire" name="CleanTire" value="1">
<label for="CleanTire">Clean Tire & shine</label>
</div>
</div>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Completeinteriorvaccuming" name="Completeinteriorvaccuming" value="1">
<label for="Completeinteriorvaccuming"> Complete interior vaccuming </label>
</div></div>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="LeatherTreated" name="LeatherTreated" value="1">
<label for="LeatherTreated"> Leather Treated </label>
</div>
</div>


<div class="form-group">
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="TiresShined" name="TiresShined" value="1">
<label for="TiresShined"> TiresShined </label>
</div>
</div>

</div>




											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2">
													<button class="btn btn-default" type="reset">Cancel</button>
													<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
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