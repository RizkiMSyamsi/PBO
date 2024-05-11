<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">

    <title><?php echo $title; ?></title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $url ?>assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/bootstrap/css/datetimepicker.css" rel="stylesheet">

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug 
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">-->

    <!-- Custom styles for this template -->
    <link href="<?php echo $url ?>assets/css/navbar-fixed-top.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/full-slider.css" rel="stylesheet">
    <link href="<?php echo $url ?>assets/css/style.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Just for debugging purposes. Don't actually copy these 2 lines! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top navbar-blue">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php" style="font-family: Monaco; font-size: 20px; font-weight: bold; color: #EEF5FF;">JAKET-KUN</a>

        </div>
        <div id="navbar" class="navbar-collapse collapse"> 
          <ul class="nav navbar-nav navbar-right">
            <li><a href="<?php echo $url ?>"> <i class="fa-solid fa-house"> </i></a></li> 
            <li><a href="<?php echo $url ?>menu.php"><i class="fa-solid fa-list"></i></a></li> 
            <li><a href="<?php echo $url ?>kontak.php"><i class="fa-solid fa-address-book"></i></a></li> 
            <li><a href="<?php echo $url ?>info.php"><i class="fa-solid fa-info"></i></a></li> 
            <?php if(!empty($_SESSION['iam_user'])){ ?>
			<?php 
				$user = mysqli_fetch_object(mysqli_query($db,"SELECT*FROM user where id='$_SESSION[iam_user]'"));
			?>
      <li><a href="<?php echo $url ?>pembayaran.php"><i class="fa-brands fa-paypal"></i> </a></li>      
			<li class="dropdown">
				
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-circle-user"></i> Hi <?php echo $user->nama; ?> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $url ?>profile.php"><i class="fa-regular fa-user"></i> Profil</a></li> 
                <li><a href="<?php echo $url ?>logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>  
              </ul>
            </li>
			<?php }else{ ?>
			<li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa-solid fa-user"></i> <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="<?php echo $url ?>login.php">Login</a></li> 
                <li><a href="<?php echo $url ?>register.php">Register</a></li>  
              </ul>
            </li>
			<?php } ?>
			

          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

   <?php if('http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'] == $url.'index.php'){ ?>
    <div class="container">

    <div class="p-3">
      <ul class="list-inline">
      <!-- <li class="list-inline-item">Item 1</li> -->
      <?php 
					$kategori = mysqli_query($db, "SELECT * FROM kategori_produk"); 
					while($data = mysqli_fetch_array($kategori)){
				?>
					<li><a href="<?php echo $url; ?>menu.php?kategori=<?php echo $data['id'] ?>" class="btn btn-primary"><?php echo $data['nama']; ?> (
					<?php 
						$ck = mysqli_num_rows(mysqli_query($db,"SELECT * FROM produk WHERE kategori_produk_id='$data[id]'"));
						if($ck > 0){ echo $ck; }else{ echo 0; } ?>
					)</a></li>
				<?php } ?>
      </ul>
    </div>

     <!-- Full Page Image Background Carousel Header -->
    <header id="myCarousel" class="carousel slide">
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li> 
            <li data-target="#myCarousel" data-slide-to="2"></li> 
        </ol>

        <!-- Wrapper for Slides -->
          <div class="carousel-inner">
            <div class="item active">
                <!-- Set the first background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/jaket1.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the second background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/jaket2.jpg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div>
            <div class="item">
                <!-- Set the third background image using inline CSS below. -->
                <div class="fill" style="background-image:url('<?php $url ?>assets/img/jaket3.jpeg');"></div>
                <div class="carousel-caption">
                    <h2></h2>
                </div>
            </div> 
        </div>

        <!-- Controls -->
        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="icon-prev"></span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="icon-next"></span>
        </a>

    </header>
    </div> <!-- /container -->
   <?php } ?>
	
	<div class="container" style="margin-top:20px;">
	<div class="row">
		<div class="col-md-3">
			<div style="border-radius: 15px; background:#9DB2BF; width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; 	margin-bottom:15px;"class = "text-center">
        
      <h4><b><button style="background:#9DB2BF; border: none;" type="button" onclick="window.location.href='<?php echo $url; ?>keranjang.php'"><i class="fas fa-cart-arrow-down"></i></button></b></h4>



			</div>
			<div style=" width:100%; height:auto; padding-top:3px;padding-bottom:3px; padding-left:10px; 	margin-bottom:15px; border: 1px solid #000; border-radius:15px;">
			
			<?php
                            if(isset($_SESSION['cart'])){
                                $total = 0;
                                $cart = unserialize($_SESSION['cart']);
                                if($cart == ''){
                                    $cart = [];
                                }
                                foreach($cart as $id => $qty){
                                    $product = mysqli_fetch_array(mysqli_query($db,"select * from produk WHERE id='$id'"));
                                    if(isset($product)){
                                       $t = $qty * $product['harga'];
                                       $total += $t;
                                    }
                                }
                                echo '<h4 style="color:#f00;">Rp '. number_format($total, 2, ',', '.') .'</h4>';
                            }else{
                                echo '<h4 style="color:#f00;">Rp 0,00</h4>';
                            }
                                
                        ?>
				
				<!-- <a href="<?php echo $url; ?>keranjang.php">Lihat Detail</a> -->
			</div>
			<div class="row col-md-12">
					
			</div>
			<div class="row col-md-12">
				<hr>

			</div>
		</div>