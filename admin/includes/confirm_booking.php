<?php
//error_reporting(0);
if(isset($_POST['confirm']))
{
$Technician_id=$_POST['Technician_id'];
$status=1;
$invoice_number=$result->invoice_number;
$EmailId=$result->EmailId;
$bookingdate=$result->bookingdate;
$timeslot=$result->timeslot;
$pid=$result->pid;

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
echo "<script type='text/javascript'> document.location = 'manage-bookings.php?aeid=<?php echo htmlentities($result->id);?>'; </script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>







<div class="modal fade" id="confirm_booking">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Assign Work Order Request</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">

                

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