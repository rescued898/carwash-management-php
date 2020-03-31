<?php
//error_reporting(0);
if(isset($_POST['confirm']))
{
$invoice_no=$_POST['invoice_no'];
$amount=$_POST['amount']; 
$payment_mode=$_POST['payment_mode'];
$trans_number=($_POST['trans_number']); 
$ref_id=$_POST['ref_id'];
$payment_date=$_POST['date'];
$sql="INSERT INTO  tblpayments(invoice_no,amount,payment_mode,trans_no,ref_id,payment_date) VALUES(:invoice_no,:amount,:payment_mode,:trans_number,:ref_id,:payment_date)";
$query = $dbh->prepare($sql);
$query->bindParam(':invoice_no',$invoice_no,PDO::PARAM_STR);
$query->bindParam(':amount',$amount,PDO::PARAM_STR);
$query->bindParam(':payment_mode',$payment_mode,PDO::PARAM_STR);
$query->bindParam(':trans_number',$trans_number,PDO::PARAM_STR);
$query->bindParam(':ref_id',$ref_id,PDO::PARAM_STR);
$query->bindParam(':payment_date',$payment_date,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
echo "<script>alert('Payment confirm successfull. Thank you');</script>";
}
else 
{
echo "<script>alert('Something went wrong. Please try again');</script>";
}
}

?>







<div class="modal fade" id="confirm_payment">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h3 class="modal-title">Confirm Payment</h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="login_wrap">
            <div class="col-md-12 col-sm-6">
              <form method="post">

                <div class="form-group">
                  <label>Invoice Number</label>
                  <input type="text" class="form-control" name="invoice_no" required="">
                </div>

                <div class="form-group">
                  <label>Amount</label>
                  <input type="text" class="form-control" name="amount" required="">
                </div>
                
                <div class="form-group">
                   <label>Select Payment Mode</label>
                   <select class="form-control" name="payment_mode">
                    <option value=""> Select </option>
                    <option value="Bcash">Bcash</option>
                    <option value="Rocket">Rocket</option>
                    <option value="Ucash">Ucash</option>
                    <option value="Bank">Bank Transfer</option>
                   </select>
                </div>


                <div class="form-group">
                   <label>Transection Number</label>
                   <input type="text" class="form-control" name="trans_number" required="">
                </div>


                <div class="form-group">                          
                    <label> Reference ID </label>                          
                    <input type="text" class="form-control" name="ref_id" required>   
                </div>

                <div class="form-group">
                  <label>Payment Date</label>
                  <input type="text" class="form-control" name="date" placeholder="2-25-2020" required="">
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