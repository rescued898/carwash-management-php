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
$CompleteCarExteriorCleaning=$_POST['CompleteCarExteriorCleaning'];
$Exterirorcarwash=$_POST['Exterirorcarwash'];
$Ecoglassclean=$_POST['Ecoglassclean'];
$Wheelclean=$_POST['Wheelclean'];
$Cleanfrontgrill=$_POST['Cleanfrontgrill'];
$CleanTire=$_POST['CleanTire'];
$Completeinteriorvaccuming=$_POST['Completeinteriorvaccuming'];
$LeatherTreated=$_POST['LeatherTreated'];
$TiresShined=$_POST['TiresShined'];
$id=intval($_GET['id']);

$sql="update tblpackage set packagetitle=:packagetitle,service_quality=:servicequality,packageoverview=:packageoverview,price1=:car_price,price2=:truck_price,price3=:bus_price,requiredtime=:requiredtime,service_type=:servicetype,CompleteCarExteriorCleaning=:CompleteCarExteriorCleaning,Exterirorcarwash=:Exterirorcarwash,Ecoglassclean=:Ecoglassclean,Wheelclean=:Wheelclean,Cleanfrontgrill=:Cleanfrontgrill,CleanTire=:CleanTire,Completeinteriorvaccuming=:Completeinteriorvaccuming,LeatherTreated=:LeatherTreated,TiresShined=:TiresShined where id=:id ";
$query = $dbh->prepare($sql);
$query->bindParam(':packagetitle',$packagetitle,PDO::PARAM_STR);
$query->bindParam(':servicequality',$servicequality,PDO::PARAM_STR);
$query->bindParam(':packageoverview',$packageoverview,PDO::PARAM_STR);
$query->bindParam(':car_price',$car_price,PDO::PARAM_STR);
$query->bindParam(':truck_price',$truck_price,PDO::PARAM_STR);
$query->bindParam(':bus_price',$bus_price,PDO::PARAM_STR);
$query->bindParam(':requiredtime',$requiredtime,PDO::PARAM_STR);
$query->bindParam(':servicetype',$servicetype,PDO::PARAM_STR);
$query->bindParam(':CompleteCarExteriorCleaning',$CompleteCarExteriorCleaning,PDO::PARAM_STR);
$query->bindParam(':Exterirorcarwash',$Exterirorcarwash,PDO::PARAM_STR);
$query->bindParam(':Ecoglassclean',$Ecoglassclean,PDO::PARAM_STR);
$query->bindParam(':Wheelclean',$Wheelclean,PDO::PARAM_STR);
$query->bindParam(':Cleanfrontgrill',$Cleanfrontgrill,PDO::PARAM_STR);
$query->bindParam(':CleanTire',$CleanTire,PDO::PARAM_STR);
$query->bindParam(':Completeinteriorvaccuming',$Completeinteriorvaccuming,PDO::PARAM_STR);
$query->bindParam(':LeatherTreated',$LeatherTreated,PDO::PARAM_STR);
$query->bindParam(':TiresShined',$TiresShined,PDO::PARAM_STR);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();

$msg="Data updated successfully";


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
	
	<title>Car Wash Portal | Admin Edit Package Info</title>

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
					
						<h2 class="page-title">Edit Package</h2>

						<div class="row">
							<div class="col-md-12">
								<div class="panel panel-default">
									<div class="panel-heading">Basic Info</div>
									<div class="panel-body">
<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
<?php 
$id=intval($_GET['id']);
$sql ="SELECT *  from tblpackage where id=:id";
$query = $dbh -> prepare($sql);
$query-> bindParam(':id', $id, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{	?>

<form method="post" class="form-horizontal" enctype="multipart/form-data">
<div class="form-group">
<label class="col-sm-2 control-label">Package Title<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="packagetitle" class="form-control" value="<?php echo htmlentities($result->packagetitle)?>" required>
</div>
<label class="col-sm-2 control-label">Select Service Quality<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="servicequality" required>
<option value="<?php echo htmlentities($result->service_quality); ?>);?>"><?php echo htmlentities($result->service_quality); ?> </option>
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
<textarea class="form-control" name="packageoverview" rows="3" required><?php echo htmlentities($result->packageoverview);?></textarea>
</div>
</div>

<div class="form-group">
<label class="col-sm-2 control-label">Price Per Vehicle<span style="color:red">*</span></label>
<div class="col-sm-2">
<input type="text" name="car_price" class="form-control" placeholder="Car" value="<?php echo htmlentities($result->price1);?>" required>Car
</div>
<div class="col-sm-2">
<input type="text" name="truck_price" class="form-control" placeholder="Truck" value="<?php echo htmlentities($result->price2);?>"required>Truck
</div>
<div class="col-sm-2">
<input type="text" name="bus_price" class="form-control" placeholder="Bus" value="<?php echo htmlentities($result->price3);?>" required>Bus
</div>
</div>


<div class="form-group">
<label class="col-sm-2 control-label">Required Time<span style="color:red">*</span></label>
<div class="col-sm-4">
<input type="text" name="requiredtime" class="form-control" value="<?php echo htmlentities($result->requiredtime);?>" required>
</div>

<label class="col-sm-2 control-label">Select Service Type<span style="color:red">*</span></label>
<div class="col-sm-4">
<select class="selectpicker" name="servicetype" required>
<option value="<?php echo htmlentities($result->service_type);?>"> <?php echo htmlentities($result->service_type);?> </option>
<option value="WATER">WATER WASH</option>
<option value="WATERLESS">WATERLESS WASH</option>
<option value="WAX">WASH AND WAX</option>
</select>
</div>
</div>


<div class="hr-dashed"></div>								
<div class="form-group">
<div class="col-sm-12">
<h4><b>Package Images</b></h4>
</div>
</div>
<div class="form-group">
<div class="col-sm-4">
Image 1 <img src="img/carwashimage/<?php echo htmlentities($result->image1);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage1.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 1</a>
</div>
<div class="col-sm-4">
Image 2<img src="img/carwashimage/<?php echo htmlentities($result->image2);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage2.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 2</a>
</div>
<div class="col-sm-4">
Image 3<img src="img/carwashimage/<?php echo htmlentities($result->image3);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage3.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 3</a>
</div>
</div>


<div class="form-group">
<div class="col-sm-4">
Image 4<img src="img/carwashimage/<?php echo htmlentities($result->image4);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage4.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 4</a>
</div>
<div class="col-sm-4">
Image 5
<?php if($result->image5=="")
{
echo htmlentities("File not available");
} else {?>
<img src="img/carwashimage/<?php echo htmlentities($result->image5);?>" width="300" height="200" style="border:solid 1px #000">
<a href="changeimage5.php?imgid=<?php echo htmlentities($result->id)?>">Change Image 5</a>
<?php } ?>
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
<?php if($result->CompleteCarExteriorCleaning==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="CompleteCarExteriorCleaning" name="CompleteCarExteriorCleaning" checked value="1">
<label for="CompleteCarExteriorCleaning"> Complete Car Exterior Cleaning </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="inlineCheckbox1" name="CompleteCarExteriorCleaning" value="1">
<label for="CompleteCarExteriorCleaning"> Complete Car Exterior Cleaning </label>
</div>
<?php } ?>
</div>

<div class="col-sm-3">
<?php if($result->Exterirorcarwash==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Exterirorcarwash" name="Exterirorcarwash" checked value="1">
<label for="Exterirorcarwash"> Exteriror carwash </label>
</div>
<?php } else {?>
<div class="checkbox checkbox-success checkbox-inline">
<input type="checkbox" id="Exterirorcarwash" name="Exterirorcarwash" value="1">
<label for="Exterirorcarwash"> Exteriror carwash </label>
</div>
<?php }?>
</div>

<div class="col-sm-3">
<?php if($result->Ecoglassclean==1)
{?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Ecoglassclean" name="Ecoglassclean" checked value="1">
<label for="Ecoglassclean"> Ecoglass clean & gloss </label>
</div>
<?php } else {?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Ecoglassclean" name="Ecoglassclean" value="1">
<label for="Ecoglassclean"> Ecoglass clean & gloss </label>
</div>
<?php } ?>
</div>

<div class="col-sm-3">
<?php if($result->Wheelclean==1)
{
	?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Wheelclean" name="Wheelclean" checked value="1">
<label for="Wheelclean"> Wheel clean & finish </label>
</div>
<?php } else {?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Wheelclean" name="Wheelclean" value="1">
<label  for="Wheelclean"> Wheel clean & finish </label>
</div>
<?php } ?>
</div>

<div class="form-group">
<?php if($result->Cleanfrontgrill==1)
{
	?>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Cleanfrontgrill" name="Cleanfrontgrill" checked value="1">
<label for="Cleanfrontgrill"> Clean frontgrill & mudflaps </label>
</div>
<?php } else {?>
<div class="col-sm-3">
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Cleanfrontgrill" name="Cleanfrontgrill" value="1">
<label for="Cleanfrontgrill"> Clean frontgrill & mudflaps </label>
</div>
<?php } ?>
</div>

<div class="col-sm-3">
<?php if($result->CleanTire==1)
{
?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="CleanTire" name="CleanTire" checked value="1">
<label for="CleanTire">Clean Tire & shine</label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="CleanTire" name="CleanTire" value="1">
<label for="CleanTire">Clean Tire & shine</label>
<?php } ?>
</div>

<div class="col-sm-3">
<?php if($result->Completeinteriorvaccuming==1)
{
?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Completeinteriorvaccuming" name="Completeinteriorvaccuming" checked value="1">
<label for="Completeinteriorvaccuming"> Complete interior vaccuming </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="Completeinteriorvaccuming" name="Completeinteriorvaccuming" value="1">
<label for="Completeinteriorvaccuming"> Complete interior vaccuming </label>
</div>
<?php } ?>
</div>

<div class="col-sm-3">
<?php if($result->LeatherTreated==1)
{
?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="LeatherTreated" name="LeatherTreated" checked value="1">
<label for="LeatherTreated"> Leather Treated </label>
</div>
<?php } else { ?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="LeatherTreated" name="LeatherTreated" value="1">
<label for="LeatherTreated"> Leather Treated </label>
</div>
<?php } ?>
</div>


<div class="form-group">
<div class="col-sm-3">
<?php if($result->TiresShined==1)
{
?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="TiresShined" name="TiresShined" checked value="1">
<label for="TiresShined"> TiresShined </label>
</div>
<?php } else {?>
<div class="checkbox checkbox-inline">
<input type="checkbox" id="TiresShined" name="TiresShined" value="1">
<label for="TiresShined">TiresShined </label>
</div>
<?php } ?>
</div>

</div>

<?php }} ?>


											<div class="form-group">
												<div class="col-sm-8 col-sm-offset-2" >
													
													<button class="btn btn-primary" name="submit" type="submit" style="margin-top:4%">Save changes</button>
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