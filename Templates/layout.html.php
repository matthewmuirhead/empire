<?php
	if (!isset($_SESSION['basket'])) {
		$_SESSION['basket'] = [];
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" href="/style.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css">
		<link href="https://fonts.googleapis.com/css?family=Libre+Baskerville" rel="stylesheet">
		<link href="https://fonts.googleapis.com/css?family=Nunito&display=swap" rel="stylesheet">
		<script type="text/javascript" src="/main.js"></script>
    <link rel="shortcut icon" href="/images/logo.png"/><!-- Favicon -->
		<title><?=$title?></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	</head>
	<body>
    <div class="header" id="header">
			<div class="header-left">
				<a href="/" class="header-img"><img src="/images/logo.png" alt="Fotheby's Auction House Logo"></a>
			</div>
      <div class="header-info">
        <div class="nav-top">
					<div class="header-left">
						<form class="search hide-search" action="/search" method="post">
							<label class="fa fa-search"></label>
							<input type="text" name="search" value="">
							<input type="submit" name="submit" value="Search" />
						</form>
					</div>
					<div class="header-right">
						<a href="/basket">
							<i class="fas fa-shopping-basket"></i>
							<?=sizeof($_SESSION['basket'])?> Items in Basket
						</a>

	          <div class="user">
	            <?php
	              if (isset($_SESSION['id'])) {
	                ?><a href="/profile"><p>Logged in as: <?=$_SESSION['user']?></p></a>
									<?php if ($_SESSION['account'] == 'Admin') { ?>
										<a href="/admin"><strong>Admin</strong></a>
									<?php } ?>
	                <a href="/logout"><strong>Logout</strong></a><?php
	              } else {
	                ?>
										<a href="/login">Login</a>
									<?php
	              }
	            ?>
	          </div>
					</div>
        </div>

        <ul class="nav-links">
          <a href="/" class="nav-button"><li>Home</li></a>
          <a href="/subscriptions" class="nav-button"><li>Subscriptions</li></a>
					<a href="/services" class="nav-button"><li>Services</li></a>
          <a href="/goods" class="nav-button"><li>Goods</li></a>
        </ul>
      </div>
    </div>
    <main>

      <?=$output?>
    </main>

    <footer>
      &copy; Empire
    </footer>


  </body>
</html>


<script>
  document.getElementById("login-popup").addEventListener('onclick', (event) => {
		console.log(document.getElementById('login-popup-form').style.display);
		document.getElementById('login-popup-form').style.display = "flex";
		console.log(document.getElementById('login-popup-form').style.display);
  });
</script>
