<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
  { 
header('location:index.php');
}
else{
//***********Calculation Discount***********
$email=$_SESSION['login'];
$sql2="select * from tblbooking where userEmail=:email";
$query2 = $dbh->prepare($sql2);
$query2->bindParam(':email',$email,PDO::PARAM_STR);
$query2->execute();
$total_service=$query2->rowCount();



?>

<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Car Wash Portal | Bookings</title>
<!--Bootstrap -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css" type="text/css">
<!--Custome Style -->
<link rel="stylesheet" href="assets/css/style.css" type="text/css">
<!--OWL Carousel slider-->
<link rel="stylesheet" href="assets/css/owl.carousel.css" type="text/css">
<link rel="stylesheet" href="assets/css/owl.transitions.css" type="text/css">
<!--slick-slider -->
<link href="assets/css/slick.css" rel="stylesheet">
<!--bootstrap-slider -->
<link href="assets/css/bootstrap-slider.min.css" rel="stylesheet">
<!--FontAwesome Font Style -->
<link href="assets/css/font-awesome.min.css" rel="stylesheet">

<!-- SWITCHER -->
		<link rel="stylesheet" id="switcher-css" type="text/css" href="assets/switcher/css/switcher.css" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/red.css" title="red" media="all" data-default-color="true" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/orange.css" title="orange" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/blue.css" title="blue" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/pink.css" title="pink" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/green.css" title="green" media="all" />
		<link rel="alternate stylesheet" type="text/css" href="assets/switcher/css/purple.css" title="purple" media="all" />
        
<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/images/favicon-icon/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/images/favicon-icon/apple-touch-icon-114-precomposed.html">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/images/favicon-icon/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="assets/images/favicon-icon/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="assets/images/favicon-icon/favicon.png">
<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900" rel="stylesheet">
</head>
<body>
 
        
<!--Header-->
<?php include('includes/header.php');?>

<?php 
$useremail=$_SESSION['login'];
$sql = "SELECT tblusers.FullName,tblusers.EmailId,tblusers.ContactNo,tblusers.Address,tblbooking.bookingdate,tblbooking.timeslot,tblbooking.cartype,tblbooking.service,tblpackage.packagetitle,tblbooking.totalprice,tblpackage.price1,tblpackage.price2,tblpackage.price3  from tblusers join tblbooking on tblusers.EmailId=tblbooking.userEmail join tblpackage on tblbooking.packageid=tblpackage.id where EmailId=:useremail order by tblbooking.id DESC LIMIT 0,1 ";
$query = $dbh -> prepare($sql);
$query->bindParam(':useremail',$useremail, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
            

$cnt=1;
$count=$query->rowCount();
if($count > 0)
{
foreach($results as $result)
{
 $totalprice=0;
 $totalprice=$result->totalprice;
 $discount=0;
?>
<section class="page-header aboutus_page">
  <div class="container">
    <div class="page-header_wrap">
      <div class="page-heading">
        <h1><?php   echo htmlentities($results->bookingdate); ?></h1>
      </div>
      <ul class="coustom-breadcrumb">
        <li><a href="#">Home</a></li>
        <li><?php   echo htmlentities($result->PageName); ?></li>
      </ul>
    </div>
  </div>
  <!-- Dark Overlay-->
  <div class="dark-overlay"></div>
</section>

<section class="about_us section-padding">
  <div class="container"><!--container start-->

  	<div class="col-md-9"><!--col-md-9 Start-->

      <h4>Booking Information</h4>

  <form class="mx-5" action="" method="POST">
    
    <div class="form-group">
      <label class="control-label">Full Name</label>
        <input class="form-control white_bg" name="fullname" value="<?php echo htmlentities($result->FullName);?>" id="fullname" type="text"  required readonly>
    </div>
    
    <div class="form-group">
              <label class="control-label">Phone Number</label>
              <input class="form-control white_bg" name="mobilenumber" value="<?php echo htmlentities($result->ContactNo);?>" id="phone-number" type="text" required>
    </div>

    <div class="form-group">
              <label class="control-label">Email Address</label>
              <input class="form-control white_bg" value="<?php echo htmlentities($result->EmailId);?>" name="emailid" id="email" type="email" required readonly>
    </div>

    <div class="form-group">
              <label class="control-label">Your Address</label>
              <textarea class="form-control white_bg" name="address" rows="4" ><?php echo htmlentities($result->Address);?></textarea>
    </div>



    <div class="form-row">
      <div class="form-group col-md-3">
        <label class="control-label">Package Name</label>
              <input class="form-control white_bg" value="<?php echo htmlentities($result->packagetitle);?>" name="packagetitle" id="packagename" type="text" required readonly>
      </div>
      <div class="form-group col-md-3">
        <label class="control-label">Car Type </label>
              <input class="form-control white_bg" value="<?php echo htmlentities($result->cartype);?>" name="cartype" id="cartype" type="text" required readonly>
      </div>
      <div class="form-group col-md-3">
        <label class="control-label">Appointment Date</label>
              <input class="form-control white_bg" value="<?php echo htmlentities($result->bookingdate);?>" name="bookingdate" id="bookingdate" type="text" required readonly>
      </div>
      <div class="form-group col-md-3">
        <label class="control-label">Service Type</label>
              <input class="form-control white_bg" value="<?php echo htmlentities($result->service);?>" name="service" id="service" type="text" required readonly>
      </div>
    </div>



    <div class="form-row">


      <div class="form-group col-md-4">
        <label class="control-label">Any Note?</label>
        <textarea rows="4" class="form-control" name="message" placeholder="Message" ></textarea>
      </div>

      <div class="form-group col-md-4">
        <label class="control-label">Select Payment Option</label>
              <select class="form-control" name="payment" required>
                <option value=""> Select </option>
                <option value="Online">Online</option>
                <option value="cash">In Cash</option>
              </select>
      </div>
      <div class="form-group col-md-4"></div>
      </div>

    <div class="form-row">
        <button type="submit" class="btn btn-danger" name="submitrequest">Confirm</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>

    
   </form>
  </div><!--col-md-9 end-->
   

   <div class="col-md-3"><!--col-md-3 Start-->
         <div class="box" id="order-summary">
           <div class="box-header">
              <h4>Booking Summary</h4>
           </div>
           <p class="text-muted">
             Shipping And addintional Costs are calculated based on the values you have entered
           </p>
           <div class="table-resposive">
             <table class="table">
             <tr>
               <td>Booking Subtotal</td>
               <th><?php echo $total; ?></th>
             </tr>
             <tr>
               <td>Package Cost</td>

               <td>
                 <?php
                 if($count<=0){echo "৳ 0";}else
                 {
                  $package_price=$totalprice-200;
                  echo "৳ $package_price";
                 };
                 ?>

               </td>
             </tr>

              <tr>
               <td>Pick Up Charge</td>
               
               <td>
                 <?php
                 if($count<=0 || ($result->service)=='Self'){echo "৳ 0";}else{echo "৳ 200";};
                 ?>

               </td>
             </tr>

             <tr>
               <td>Tax</td>
               <td>৳ 40</td>
             </tr>

             <tr>
               <td>Discount</td>
               
               <td>
                 <?php
                 if($count<=0 || $total_service<10){echo "৳ 0";}
                 elseif($total_service>10)
                  {
                   $discount=$totalprice*0.1;
                   echo "৳ $discount";
                  }
                 elseif($total_service>1)
                  {
                   $discount=$totalprice*0.15;
                   echo "৳ $discount";
                  };
                 ?>

               </td>
             </tr>

             <tr class="total">
               <td>Total</td>
               <td>৳<?php 
                if($count<=0){echo "0";}
                elseif(($result->service)=='Self')
                {
                  $totalprice=$totalprice-($discount+160);
                  echo " $totalprice";
                } 
                else
                  {
                    $totalprice=($totalprice+40)-$discount;
                    echo " $totalprice";
                  };

                ?></td>
             </tr>


           </table>
           </div>
         </div>
       </div><!--col-md-3 end-->
   <?php }} ?>
  </div><!--container end-->
</section>
<!-- /About-us--> 





<<!--Footer -->
<?php include('includes/footer.php');?>
<!-- /Footer--> 

<!--Back to top-->
<div id="back-top" class="back-top"> <a href="#top"><i class="fa fa-angle-up" aria-hidden="true"></i> </a> </div>
<!--/Back to top--> 

<!--Login-Form -->
<?php include('includes/login.php');?>
<!--/Login-Form --> 

<!--Register-Form -->
<?php include('includes/registration.php');?>

<!--/Register-Form --> 

<!--Forgot-password-Form -->
<?php include('includes/forgotpassword.php');?>
<!--/Forgot-password-Form --> 

<!-- Scripts --> 
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<!--Switcher-->
<script src="assets/switcher/js/switcher.js"></script>
<!--bootstrap-slider-JS--> 
<script src="assets/js/bootstrap-slider.min.js"></script> 
<!--Slider-JS--> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>

<!-- Mirrored from themes.webmasterdriver.net/carforyou/demo/about-us.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 16 Jun 2017 07:26:12 GMT -->
</html>


<?php 
//*************Confirm Booking update*******
if(isset($_POST['submitrequest']))
  {

$address=$_POST['address'];
$message=$_POST['message'];
$payment=$_POST['payment'];
$mobilenumber=$_POST['mobilenumber'];
$sql1="update tblbooking set address=:address,message=:message,payment_opt=:payment,contact_num=:mobilenumber,totalprice=:totalprice order by id desc limit 1";
$query1 = $dbh->prepare($sql1);
$query1->bindParam(':address',$address,PDO::PARAM_STR);
$query1->bindParam(':message',$message,PDO::PARAM_STR);
$query1->bindParam(':payment',$payment,PDO::PARAM_STR);
$query1->bindParam(':mobilenumber',$mobilenumber,PDO::PARAM_STR);
$query1->bindParam(':totalprice',$totalprice,PDO::PARAM_STR);
$query1->execute();

 echo "<script>alert('Booking Confirmed.');</script>";

 echo "<script>window.open('index.php','_self')</script>";
}

?>


<?php } ?>