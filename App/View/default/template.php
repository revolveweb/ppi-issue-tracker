<?php if(!isset($isAjax) || $isAjax == false) { ?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>css/framework.css"/>
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>css/formbuilder.css"/>	
	<link rel="stylesheet" type="text/css" href="<?php echo $baseUrl; ?>css/style.css"/>
	<script type="text/javascript" language="javascript" src="<?php echo $baseUrl; ?>scripts/jquery1.4.2.min.js"></script>
	<script type="text/javascript">var baseUrl = "<?php echo $baseUrl; ?>";</script>
	<?php include_once($viewDir . 'framework/javascript.php'); ?>
	<?php include_once($viewDir . 'framework/stylesheet.php'); ?>
	<title>PPI framework | Open Source PHP Framework</title>
	
	<style type="text/css">
#wrapper {
margin:0 auto;
position:relative;
text-align:left;
width:985px;
margin-bottom: 200px;
}
	</style>	
</head>

<body>
<!--
		<header>

			<div class="wrap">
				
				<div id="logo">
					<h1>PPI framework</h1>
					<span>Open Source PHP Framewo rk</span>
				</div>
				<nav>
			
				<ul>
					<li class="img"><a href="#"><img src="images/icons/home.png" alt="Home" title="Home"/></a></li>
					<li><a href="#" class="current">Activity</a></li>
					<li><a href="#">Issues</a>
						<ul>
							<li><a href="#">Forums</a></li>
							<li><a href="#">Credits</a></li>
						</ul>
					</li>
					<li><a href="#">News</a></li>
					<li><a href="#">Wiki</a></li>
					<li><a href="#">Track</a></li>
				</ul>
				
			</nav>
			</div>
		</header>
		-->

		<div id="wrapper" style="">

			<header class="box_shadow">
				<ul>
					<li><a href="<?php echo $baseUrl; ?>" title="Home">Home</a></li>
					<?php if($isLoggedIn): ?>
					<li><a href="<?php echo $baseUrl; ?>ticket/create" title="Logout">Create ticket</a></li>
					<li><a href="<?php echo $baseUrl; ?>ticket/index/filter/mine" title="Logout">My Tickets</a></li>
					<li><a href="<?php echo $baseUrl; ?>user/logout" title="Logout">Logout</a></li>
					<li style="float: right;"><span>Greetings, <?php echo $authInfo['first_name']; ?></span></li>
					<?php else: ?>
					<li><a href="<?php echo $baseUrl; ?>user/login" title="Login">Login</a></li>
					<li><a href="<?php echo $baseUrl; ?>user/register" title="Login">Sign up</a></li>
					<?php endif; ?>
				
				</ul>
			</header>		
		
		<?php include $viewDir . "framework/flashmessage.php" ?>
		<?php include_once($viewDir . $actionFile); ?>
		</div>

		
		
	</body>
</html> 
<?php } else { ?>
			<?php include_once($viewDir . $actionFile); ?>
<?php } ?>