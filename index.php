<?php
  session_start();
  require_once('mysqli.php');
  $sql_e = "SELECT trimid,img,model FROM car";
  $res_e = mysqli_query($mysqli1, $sql_e);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Tesla</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <style>
  html,body{
    height:100%;
  }
  .carousel,.item,.active{
    height:100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
  }
  .bg {

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
  .carousel-inner{
      height:100%;
  }
  .carousel-inner img {
    width: 100%; /* Set width to 100% */
    margin: auto;
  }
  .navbar {
    font-family: Montserrat, sans-serif;
    margin-bottom: 0;
    background-color: #2d2d30;
    border: 0;
    font-size: 11px !important;
    letter-spacing: 4px;
    opacity: 0.9;
  }
  .navbar li a, .navbar .navbar-brand { 
    color: #d5d5d5 !important;
  }
  .navbar-nav li a:hover {
    color: #fff !important;
  }
  .navbar-nav li.active a {
    color: #fff !important;
    background-color: #29292c !important;
  }
  .navbar-default .navbar-toggle {
    border-color: transparent;
  }
  .active img{
    min-width:100%;
    min-height:100%;
  }
  li{
    padding-right:10px;
  }
  .navar-brand .navbar-text{
	  color:red;
  }
  .btn {
    padding: 10px 50px;
    background-color:white;
    color: black;
    border-radius: 20px;
    transition: .9s;
	opacity:0.8;
  }
  .btn:hover, .btn:focus {
    border: 1px solid #333;
    background-color: #dddddd;
    color: #000;
  }
  .model{
   position: absolute;
   top:10%;
}


html{
	scroll-snap-type: y mandatory;
}
.carousel{
	scroll-snap-align: start;
}
  </style>
</head>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="50">
  <nav class="navbar navbar-default navbar-fixed-top">
    <!-- Brand/logo -->
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>                        
        </button>
        <a class="navbar-brand" href="#myPage" style="color:red;">TESLA</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <!-- Links -->
        <ul class="nav navbar-nav navbar-right">
          <li class="nav-item active">
            <a class="nav-link" href="index.php">HOME</a>
          </li>
		  <?php
		  if(!isset($_SESSION['userid']))
		  {
          echo'<li class="nav-item">
            <a class="nav-link" href="register.php">SIGN UP</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="signIn.php">LOG IN</a>
          </li>
		  <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>';
		  }
		  else
		  {
			  echo'<li class="nav-item">
            <a class="nav-link" href="signOut.php">LOG OUT</a>
          </li>
		  <li><a href="#"><span class="glyphicon glyphicon-search"></span></a></li>';
		  }
		  ?>
        </ul>
        </div>
    </div>
  </nav>
  <div id="myCarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
      <li data-target="#myCarousel" data-slide-to="1"></li>
      <li data-target="#myCarousel" data-slide-to="2"></li>
	  <li data-target="#myCarousel" data-slide-to="3"></li>
	  <li data-target="#myCarousel" data-slide-to="4"></li>
	  <li data-target="#myCarousel" data-slide-to="5"></li>
	  <li data-target="#myCarousel" data-slide-to="6"></li>
	  <li data-target="#myCarousel" data-slide-to="7"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
      <div class="item active">
        <img src="static/img/img1.jpg" alt="New York" width="1200" height="700">     
      </div>

      <div class="item">
        <img src="static/img/img2.jpg" alt="Chicago" width="1200" height="700">    
      </div>
    
      <div class="item">
        <img src="static/img/img3.jpg" alt="Los Angeles" width="1200" height="700">    
      </div>
	  
	  <div class="item">
        <img src="static/img/img10.jpeg" alt="Los Angeles" width="1200" height="700">    
      </div>
	  
	  <div class="item">
        <img src="static/img/img11.jpeg" alt="Los Angeles" width="1200" height="700">    
      </div>
	  
	  <div class="item">
        <img src="static/img/img12.jpeg" alt="Los Angeles" width="1200" height="700">    
      </div>
	  
	  <div class="item">
        <img src="static/img/img13.jpeg" alt="Los Angeles" width="1200" height="700">    
      </div>
    </div>

    <!-- Left and right controls -->
    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
      <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
      <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
</div>

  <?php
    if($res_e && mysqli_num_rows($res_e) > 0)
    {
      foreach($res_e as $res)
      {
       echo '<div id="myCarousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner"><div class="item active"><img src="data:image/jpeg;base64,'.base64_encode( $res['img'] ).' "/>
        </div>
        </div>
		<div class="carousel-caption model"><h2>'.$res['model'].'</div>
        <div class="carousel-caption">
        <input type="button" class=" btn" data-toggle="modal" data-target="#myModal" onclick="ch();" value="BUY NOW"></input>
		<input type="button" class=" btn" data-toggle="modal" data-target="#myModal" onclick="ch1();" value="DETAILS"></input>
        </div>
        </div>';
      }
    }
  ?>
</div>
</body>
</html>
<script>
function ch(){
window.location.href=<?php echo '"payment.php?trimid='.$res['trimid'].'"' ?>
}
function ch1(){
window.location.href=<?php echo '"design.php?trimid='.$res['trimid'].'"' ?>
}
</script>