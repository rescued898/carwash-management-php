<?php 
session_start();
include('includes/config.php');
error_reporting(0);
if(isset($_POST['submit']))
{
$invoice_no = mt_rand();
$pkid=$_GET['pkid'];
$cartype=$_POST['cartype'];
$service=$_POST['service'];
$bookingdate=$_POST['bookingdate'];
$timeslot=$_POST['timeslot']; 
$useremail=$_SESSION['login'];


  //check price
  
   $sql3="SELECT * from tblpackage where id=:pkid";
   $query3 = $dbh->prepare($sql3);
   $query3->bindParam(':pkid',$pkid,PDO::PARAM_STR);
   $query3->execute();
   $results3=$query3->fetchAll(PDO::FETCH_OBJ);
   foreach($results3 as $result)
   {
   if($cartype=='Car'){$totalprice=$result->price1;}
   if($cartype=='Truck'){$totalprice=$result->price2;}
   if($cartype=='Bus'){$totalprice=$result->price3;}
   if($service=='Pickup'){$totalprice=$totalprice+ 200;}
   }
   

  //Check Booking date
   $sql1="SELECT * from tblbooking where bookingdate=:bookingdate";
   $query1 = $dbh->prepare($sql1);
   $query1->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
   $query1->execute();


   //Check Booking time
   $sql2="SELECT * from tblbooking where bookingdate=:bookingdate and timeslot=:timeslot";
   $query2 = $dbh->prepare($sql2);
   $query2->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
   $query2->bindParam(':timeslot',$timeslot,PDO::PARAM_STR);
   $query2->execute();


   if($query1->rowCount() > 1)
   {
        echo "<script>alert('Sorry, This Day is filled up !, try for another day!');</script>";
        
   } 

   elseif($query2->rowCount() > 1)
   {
        echo "<script>alert('Sorry, This Time slot is filled up !, try for another one!');</script>";
        
   }
   else{ 

                    $status=0;
                    
                    $sql="INSERT INTO  tblbooking(userEmail,packageid,bookingdate,timeslot,Status,service,cartype,totalprice,invoice_number) VALUES                    (:useremail,:pkid,:bookingdate,:timeslot,:status,:service,:cartype,:totalprice,:invoice_no)";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':useremail',$useremail,PDO::PARAM_STR);
                    $query->bindParam(':pkid',$pkid,PDO::PARAM_STR);
                    $query->bindParam(':bookingdate',$bookingdate,PDO::PARAM_STR);
                    $query->bindParam(':timeslot',$timeslot,PDO::PARAM_STR);
                    $query->bindParam(':status',$status,PDO::PARAM_STR);
                    $query->bindParam(':service',$service,PDO::PARAM_STR);
                    $query->bindParam(':cartype',$cartype,PDO::PARAM_STR);
                    $query->bindParam(':totalprice',$totalprice,PDO::PARAM_STR);
                    $query->bindParam(':invoice_no',$invoice_no,PDO::PARAM_STR);
                    $query->execute();
                    $lastInsertId = $dbh->lastInsertId();
                    if($lastInsertId)
                    {
                    echo "<script>alert('Booking successfull.');</script>";

                    echo "<script>window.open('cart.php','_self')</script>";
                    }
                    else 
                    {
                    echo "<script>alert('Something went wrong. Please try again');</script>";
                    }
        }            

}

?>


<!DOCTYPE HTML>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="keywords" content="">
<meta name="description" content="">
<title>Car Wash Port | Package Details</title>
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
<!-- /Header --> 

<!--Listing-Image-Slider-->

<?php 
$pkid=intval($_GET['pkid']);
$sql = "SELECT * from tblpackage  where id=:pkid";
$query = $dbh -> prepare($sql);
$query->bindParam(':pkid',$pkid, PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
 
?>  

<section id="listing_img_slider">
  <div class="col-md-9"><img src="admin/img/carwashimage/<?php echo htmlentities($result->image1);?>" class="img-responsive" alt="image" width="400" height="200"></div>
  <div class="col-md-9"><img src="admin/img/carwashimage/<?php echo htmlentities($result->image2);?>" class="img-responsive" alt="image" width="400" height="200"></div>
  <div class="col-md-9"><img src="admin/img/carwashimage/<?php echo htmlentities($result->image3);?>" class="img-responsive" alt="image" width="400" height="200"></div>
  <div class="col-md-9"><img src="admin/img/carwashimage/<?php echo htmlentities($result->image4);?>" class="img-responsive"  alt="image" width="400" height="200"></div>
  <?php if($result->image5=="")
{

} else {
  ?>
  <div class="col-md-9"><img src="admin/img/carwashimage/<?php echo htmlentities($result->image5);?>" class="img-responsive" alt="image" width="400" height="200"></div>
  <?php } ?>
</section>
<!--/Listing-Image-Slider-->


<!--Listing-detail-->
<section class="listing-detail">
  <div class="container">
    <div class="listing_detail_head row">
      <div class="col-md-9">
        <h2><?php echo htmlentities($result->packagetitle);?></h2>
      </div>
      <div class="col-md-3">
        <div class="price_info">
          <p>৳<?php echo htmlentities($result->price1);?> - ৳<?php echo htmlentities($result->price3);?></p>
         
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-md-9">
        <div class="main_features">
          <ul>
          
            <li> <i class="fa fa-car" aria-hidden="true"></i>
              <h5>৳<?php echo htmlentities($result->price1);?></h5>
              
            </li>
            <li> <i class="fa fa-truck" aria-hidden="true"></i>
              <h5>৳<?php echo htmlentities($result->price2);?></h5>
             
            </li>
       
            <li> <i class="fa fa-bus" aria-hidden="true"></i>
              <h5>৳<?php echo htmlentities($result->price3);?></h5>
              
            </li>
          </ul>
        </div>

        <div class="listing_more_info">
          <div class="listing_detail_wrap"> 
            <!-- Nav tabs -->
            <ul class="nav nav-tabs gray-bg" role="tablist">
              <li role="presentation" class="active"><a href="#package-overview " aria-controls="package-overview" role="tab" data-toggle="tab">Package Overview </a></li>
          
              <li role="presentation"><a href="#accessories" aria-controls="accessories" role="tab" data-toggle="tab">WHAT YOU GET</a></li>
            </ul>
            
            <!-- Tab panes -->
            <div class="tab-content"> 

              <!-- package-overview -->
              <div role="tabpanel" class="tab-pane active" id="package-overview">
                
                <p><?php echo htmlentities($result->packageoverview);?></p>
              </div>
              
              
              <!-- Accessories -->
              <div role="tabpanel" class="tab-pane" id="accessories"> 
                <!--Accessories-->
                <table>
                  <thead>
                    <tr>
                      <th colspan="2">Services</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>Complete Car Exterior Cleaning</td>
                       <?php if($result->CompleteCarExteriorCleaning==1)
                       {
                       ?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else { ?> 
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?> </tr>


                      <tr>
                      <td>Exteriror carwash</td>
                      <?php if($result->Exterirorcarwash==1)
                      {
                      ?>
                      <td><i class="fa fa-check" aria-hidden="true"></i></td>
                      <?php } else {?>
                      <td><i class="fa fa-close" aria-hidden="true"></i></td>
                      <?php } ?>
                    </tr>


                     <tr>
                     <td>Ecoglass clean & gloss</td>
                     <?php if($result->Ecoglassclean==1)
                     {
                     ?>
                     <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     <?php } else { ?>
                     <td><i class="fa fa-close" aria-hidden="true"></i></td>
                     <?php } ?>
                     </tr>
                   

                     <tr>
                     <td>Wheel clean & finish</td>
                     <?php if($result->Wheelclean==1)
                     {
                     ?>
                     <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     <?php } else { ?>
                     <td><i class="fa fa-close" aria-hidden="true"></i></td>
                     <?php } ?>
                     </tr>
                   
                      <tr>
                     <td>Clean frontgrill & mudflaps</td>
                     <?php if($result->Cleanfrontgrill==1)
                     {
                     ?>
                     <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     <?php } else { ?>
                     <td><i class="fa fa-close" aria-hidden="true"></i></td>
                     <?php } ?>
                     </tr>

                     <tr>
                     <td>Clean Tire & shine</td>
                     <?php if($result->CleanTire==1)
                     {
                     ?>
                     <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     <?php } else { ?>
                     <td><i class="fa fa-close" aria-hidden="true"></i></td>
                     <?php } ?>
                     </tr>

                     <tr>
                     <td>Complete interior vaccuming</td>
                     <?php if($result->Completeinteriorvaccuming==1)
                     {
                     ?>
                     <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     <?php } else { ?>
                     <td><i class="fa fa-close" aria-hidden="true"></i></td>
                     <?php } ?>
                     </tr>

                     <tr>
                     <td>Leather Treated</td>
                     <?php if($result->LeatherTreated==1)
                     {
                     ?>
                     <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     <?php } else { ?>
                     <td><i class="fa fa-close" aria-hidden="true"></i></td>
                     <?php } ?>
                    </tr>


                     <tr>
                     <td>TiresShined</td>
                     <?php if($result->TiresShined==1)
                     {
                     ?>
                     <td><i class="fa fa-check" aria-hidden="true"></i></td>
                     <?php  } else { ?>
                     <td><i class="fa fa-close" aria-hidden="true"></i></td>
                     <?php } ?>
                     </tr>


 



                  </tbody>
                </table>
              </div>
            </div>
          </div>
          
        </div>
<?php }} ?>
   
      </div>
      
      <!--Side-Bar-->
      <aside class="col-md-3">
      
        <div class="share_package">
          <p>Share: <a href="#"><i class="fa fa-facebook-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-twitter-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a> <a href="#"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a> </p>
        </div>


        <div class="sidebar_widget">
          <div class="widget_heading">
            <h5><i class="fa fa-envelope" aria-hidden="true"></i>Book Now</h5>
          </div>
          <form method="post">
            <div class="form-group">
              <label for="inputDate">Appointment Date</label>
              <input type="Date" class="form-control" name="bookingdate" placeholder="Booking Date" required>
            </div>


            <div class="form-group">
              
                <label for="inputDate">Select Slot Interval</label>
                <select class="form-control" name="timeslot" required>
                <option value=""> Select </option>
                <option value="10-11">10:00 AM to 11:00 AM</option>
                <option value="11-12">11:00 AM to 12:00 PM</option>
                <option value="1-2">1:00 PM to 2:00 PM</option>
                <option value="2-3">2:00 PM to 3:00 PM</option>
                <option value="3-4">3:00 PM to 4:00 PM</option>
                <option value="4-5">4:00 PM to 5:00 PM</option>
                <option value="5-6">5:00 PM to 6:00 PM</option>
                <option value="6-7">6:00 PM to 7:00 PM</option>
                <option value="7-8">7:00 PM to 8:00 PM</option>
                </select>
                
            </div>

            <div class="form-group">
              
                <label for="inputDate">Select Service</label>
                <select class="form-control" name="service" required>
                <option value=""> Select </option>
                <option value="Self">Self Driving</option>
                <option value="Pickup">Pick Up</option>
                </select>
                
            </div>

            <div class="form-group">
              
                <label for="inputDate">Select Car Type</label>
                <select class="form-control" name="cartype" required>
                <option value=""> Select </option>
                <option value="Car">Car</option>
                <option value="Truck">Truck</option>
                <option value="Bus">Bus</option>
                </select>
                
            </div>

            
          <?php if($_SESSION['login'])
              {?>
              <div class="form-group">
                <input type="submit" class="btn"  name="submit" value="Book Now">
              </div>
              <?php } else { ?>
<a href="#loginform" class="btn btn-xs uppercase" data-toggle="modal" data-dismiss="modal">Login For Book</a>

              <?php } ?>
          </form>
        </div>
      </aside>
      <!--/Side-Bar--> 
    </div>
    
    <div class="space-20"></div>
    <div class="divider"></div>
    
    <!--Similar-Cars-->
    <div class="similar_cars">
      <h3>Similar Packages</h3>
      <div class="row">
<?php 

 $sql = "SELECT packagetitle,price1,price2,price3,id,image1,packageoverview from tblpackage order by rand() LIMIT 0,4";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{  
?>     
        <div class="col-md-3 col-sm-3 grid_listing">
          <div class="product-listing-m gray-bg">
            <div class="product-listing-img"> <a href="package-details.php?pkid=<?php echo htmlentities($result->id);?>"><img src="admin/img/carwashimage/<?php echo htmlentities($result->image1);?>" class="img-responsive" alt="image" /> </a>
            </div>
            <div class="product-listing-content">
              <h5><a href="package-details.php?pkid=<?php echo htmlentities($result->id);?>"><?php echo htmlentities($result->packagetitle);?></a></h5>

            <li><i class="fa fa-car" aria-hidden="true"></i>৳<?php echo htmlentities($result->price1);?></li>

            <li><i class="fa fa-truck" aria-hidden="true"></i>৳<?php echo htmlentities($result->price2);?></li>

            <li><i class="fa fa-bus" aria-hidden="true"></i>৳<?php echo htmlentities($result->price3);?></li>
          
              
            </div>
          </div>
        </div>
 <?php }} ?>       

      </div>
    </div>
    <!--/Similar-Cars--> 
    
  </div>
</section>
<!--/Listing-detail--> 

<!--Footer -->
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

<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script> 
<script src="assets/js/interface.js"></script> 
<script src="assets/switcher/js/switcher.js"></script>
<script src="assets/js/bootstrap-slider.min.js"></script> 
<script src="assets/js/slick.min.js"></script> 
<script src="assets/js/owl.carousel.min.js"></script>

</body>
</html>