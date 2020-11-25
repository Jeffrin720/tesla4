<?php
  session_start();
  require_once('mysqli.php');
  if(!isset($_SESSION['userid']))
  {
	  header('Location:signIn.php');
	  exit();
  }
  if(isset($_POST['nameOnCard']))
  {
	  if((date('y')<$_POST['year'])||(date('y')==$_POST['year'] && date('m')<$_POST['month']))
	  {
		  $sql="insert into orders_placed(emailid,trimid) values ('".$_SESSION['userid']."','".$_SESSION['trimid']."')";
		  $mysqli1->query($sql);
		  $orderId=mysqli_insert_id($mysqli1);
		  $sql="insert into payment(name_on_card,billing_zip,cvv,expiry_date,credit_card_no,orderid) values('".$_POST['nameOnCard']."',".$_POST['zip'].",".$_POST['cv'].",STR_TO_DATE('1-".$_POST['month']."-".$_POST['year']."','%e-%m-%y'),".$_POST['cardNumber'].",".$orderId.")";
		  $mysqli1->query($sql);
		  $sql="insert into location(orderid,doorno,city,country,zip_code) values(".$orderId.",'".$_POST['doorNo']."','".$_POST['city']."','".$_POST['country']."',".$_POST['zip'].")";
		  $mysqli1->query($sql);
		  header("Location:success.php");
		  exit();
	  }
	  else
	  {
		  
		  $_SESSION['err']="Credit card expired";
		  header('Location:payment.php?trimid='.$_SESSION['trimid']);
		  exit();
	  }
  }
  else
  {
	  $sql_e = "SELECT cost FROM car where trimid='".$_GET['trimid']."'";
	  $res_e = mysqli_query($mysqli1, $sql_e);
	  $_SESSION['trimid']=$_GET['trimid'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
</head>
<style>
    body { margin-top:3%;
	margin-left:38%;
	}
    .panel-title {display: inline;font-weight: bold;}
    .checkbox.pull-right { margin: 0; }
    .pl-ziro { padding-left: 0px; }
	.err{
		
	}
</style>
<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Payment Details
                        </h3>
                        <div class="checkbox pull-right">
                            <label>
                                <input type="checkbox" />
                                Remember
                            </label>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" action="payment.php">
						<div class="form-group">
                            <label for="nameOnCard">
                                NAME ON CARD</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="nameOnCard" placeholder="Name on card" name="nameOnCard"
                                    required autofocus />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="cardNumber">
                                CARD NUMBER</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="cardNumber" placeholder="Valid Card Number" name="cardNumber"
                                    required autofocus />
                                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-7 col-md-7">
                                <div class="form-group">
                                    <label for="expityMonth">
                                        EXPIRY DATE</label>
                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                        <input type="text" class="form-control" id="expityMonth" placeholder="MM" name="month" required />
                                    </div>
                                    <div class="col-xs-6 col-lg-6 pl-ziro">
                                        <input type="text" class="form-control" id="expityYear" placeholder="YY" name="year" required /></div>
                                </div>
                            </div>
                            <div class="col-xs-5 col-md-5 pull-right">
                                <div class="form-group">
                                    <label for="cvCode">
                                        CV CODE</label>
                                    <input type="password" class="form-control" id="cvCode" placeholder="CV" name="cv" required />
                                </div>
                            </div>
                        </div>
						<?php if (isset($_SESSION['err'])): ?>
						<b><span style="color:red;"><?php echo $_SESSION['err'];unset($_SESSION['err']);?></span></b>
						<?php endif ?>
						<center><u><h3 class="panel-title" style="">Delivery Address</h3></u></center>
						<div class="form-group">
                            <label for="doorNo">
                                Door No</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="doorNo" placeholder="Door No" name="doorNo"
                                    required autofocus />
                            </div>
							<label for="city">
                                City</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="city" placeholder="City" name="city"
                                    required autofocus />
                            </div>
							<label for="country">
                                Country</label>
                            <div class="input-group">
                                <input type="text" class="form-control" id="country" placeholder="Country" name="country"
                                    required autofocus />
                            </div>
							<label for="zipCode">
                                Zip Code</label>
                            <div class="input-group">
                                <input type="number" class="form-control" id="zipCode" placeholder="Zip Code" name="zip"
                                    required autofocus />
                            </div>
                        </div>
						<ul class="nav nav-pills nav-stacked">
						<li class="active"><a href="#"><span class="badge pull-right"><span class="glyphicon glyphicon-usd"></span>
						<?php
						if($res_e && mysqli_num_rows($res_e) > 0)
						{
							foreach($res_e as $res)
							{
								echo $res['cost'];
							}
						}
						?>
						</span> Final Payment</a>
						</li>
						</ul>
						<br/>
						<input type="submit" class="btn btn-success btn-lg btn-block" role="button" value="Pay Now">
                        </form>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>
