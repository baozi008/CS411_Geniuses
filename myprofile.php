<?php
	include_once "db_functions.php";	
	session_start(); 
	$curr_user = $_SESSION['curr_user'];
	$msg = "";
	if (empty($curr_user)) {
		$msg = "curr_user is empty";
	}
	else {
		$conn = connectDB();

		if ($_SERVER["REQUEST_METHOD"] == "POST") {
			$name = ppc($_POST["name"]);
			$email = ppc($_POST["email"]);
			$campus = $_POST['campus'];
			$major = $_POST['major'];
			$year = $_POST['year'];
			$msg = $nameErr = $emailErr = "";
			
			if (empty($name)) {
				$nameErr = "* Name cannot be empty.";
			}
			if (empty($email)) {
				$emailErr = "* Email cannot be empty.";
			} else if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
				$emailErr = "* Invalid email format."; 
			}
			if ($nameErr || $emailErr) {
				$msg = "* Please check your input again";
			} 
			else {
				$sql = "UPDATE Users 
						SET name = '$name', campus = '$campus', email = '$email', major = '$major', year = '$year'
						WHERE NetId = '$curr_user'";
				if ($conn->query($sql)) {
					$msg = "Successfully changed!";
					// header("location:profile.php");
					// exit;
				} else {
					$msg = "Error: " . $sql . "<br>" . $conn->error;
				}
			}
		}
		else {
			$sql = "SELECT * FROM Users WHERE NetId='$curr_user' ";
			$result = $conn->query($sql);
			if ($result && $result->num_rows == 1) {
				$row = $result->fetch_assoc();
				$username = $row["NetId"];
				$name = $row["Name"];
				$email = $row["Email"];
				$campus = $row["Campus"];
				$year = $row["Year"];
				$major = $row["Major"];
			} else {
				$msg = "curr_user is not in database!";
			}
		}

		$conn->close();
	}
	// echo "<script>console.log('$msg');</script>";

?>

<!DOCTYPE html>
<html lang="en">

<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>Beacon - User Profile</title>
	<meta name="description" content="Bootstrap Metro Dashboard">
	<meta name="author" content="">
	<meta name="keyword" content="">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
		
</head>

<body>

	<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.php"><span>BEACON</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
						
						
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<span><span><i class="icon-user"> </i><?php echo $curr_user; ?></span></span>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span><?php echo $curr_user; ?></span>
								</li>
								<li><a href="myprofile.php"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->

					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- end: Header -->
	
	<div class="container-fluid-full">
	<div class="row-fluid">
			
	<!-- start: Main Menu -->
	<div id="sidebar-left" class="span2">
		<div class="nav-collapse sidebar-nav">
			<ul class="nav nav-tabs nav-stacked main-menu">
				<!-- <i class="icon-user"></i> icon-user -->
				<li><a href="myprofile.php"><i class="icon-user"></i><span class="hidden-tablet"> Personal Information</span></a></li>
				<li><a href="myproducts.php"><i class="icon-inbox"></i><span class="hidden-tablet"> My Products</span></a></li>
				<li><a href="myrequests.php"><i class="icon-flag"></i><span class="hidden-tablet"> My Requests</span></a></li>
				<li><a href="myorders.php"><i class="icon-list"></i><span class="hidden-tablet"> Orders</span></a></li>	
				<li><a href="mytransactions.php"><i class="icon-money"></i><span class="hidden-tablet"> Transactions</span></a></li>
				<li><a href="mymessages.php"><i class="icon-envelope"></i><span class="hidden-tablet"> Messages</span></a></li>
				<li><a href="dashboard.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li>
				
			</ul>
		</div>
	</div>
	<!-- end: Main Menu -->
			
	<noscript>
		<div class="alert alert-block span10">
			<h4 class="alert-heading">Warning!</h4>
			<p>You need to have <a href="" target="_blank">JavaScript</a> enabled to use this site.</p>
		</div>
	</noscript>
			
	<!-- start: Content -->
	<div id="content" class="span10">

		<div class="row-fluid sortable">
			<div class="box span12">
				<div class="box-header" data-original-title>
					<h2><i class="halflings-icon white edit"></i><span class="break"></span>Personal Information</h2>
					<div class="box-icon">
						<a href="#" class="btn-setting"><i class="halflings-icon white wrench"></i></a>
						<a href="#" class="btn-minimize"><i class="halflings-icon white chevron-up"></i></a>
						<a href="#" class="btn-close"><i class="halflings-icon white remove"></i></a>
					</div>
				</div>

				<div class="box-content">
					<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST">
						<fieldset>

							<div class="control-group">
								<label class="control-label">Username</label>
								<div class="controls">
									<span class="input-xlarge uneditable-input"><?php echo $curr_user; ?></span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="focusedInput">Name</label>
								<div class="controls">
									<input class="input-xlarge focused" id="focusedInput" type="text" name="name" value="<?php echo $name; ?>">
									<span class="warning" style="color:crimson;"> <?php echo $nameErr;?></span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="focusedInput">Email</label>
								<div class="controls">
									<input class="input-xlarge focused" id="focusedInput" type="text" name="email" value="<?php echo $email; ?>">
									<span class="warning" style="color:crimson;"> <?php echo $emailErr;?></span>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="selectError3">Campus</label>
								<div class="controls">
								<select id="selectError3" name="campus">
									<option value='UIUC' <?php echo $campus=='UIUC' ? 'selected':'' ?>>UIUC</option>
									<option value='ZJUIntl' <?php echo $campus=='ZJUIntl' ? 'selected':'' ?>>ZJUIntl</option>
									<option value='ZJU' <?php echo $campus=='ZJU' ? 'selected':'' ?>>ZJU</option>
								</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="selectError3">School Year</label>
								<div class="controls">
								<select id="selectError3" name="year">
									<option value='Freshman' <?php echo $year=='Freshman' ? 'selected':'' ?>>Freshman</option>
									<option value='Sophomore' <?php echo $year=='Sophomore' ? 'selected':'' ?>>Sophomore</option>
									<option value='Junior' <?php echo $year=='Junior' ? 'selected':'' ?>>Junior</option>
									<option value='Senior' <?php echo $year=='Senior' ? 'selected':'' ?>>Senior</option>
									<option value='Graduate' <?php echo $year=='Graduate' ? 'selected':'' ?>>Graduate</option>
								</select>
								</div>
							</div>

							<div class="control-group">
								<label class="control-label" for="selectError3">Major</label>
								<div class="controls">
								<select id="selectError3" name="major">
									<option value='BMI' <?php echo $major=='BMI' ? 'selected':'' ?>>BMI</option>
									<option value='BMS' <?php echo $major=='BMS' ? 'selected':'' ?>>BMS</option>
									<option value='CS' <?php echo $major=='CS' ? 'selected':'' ?>>Computer Science</option>
									<option value='CompE' <?php echo $major=='CompE' ? 'selected':'' ?>>Computer Engineering</option>
									<option value='CEE' <?php echo $major=='CEE' ? 'selected':'' ?>>Civil and Environment Engineering</option>
									<option value='EE' <?php echo $major=='EE' ? 'selected':'' ?>>Electrical Engineering</option>
									<option value='ME' <?php echo $major=='ME' ? 'selected':'' ?>>Mechanical Engineering</option>
									<option value='Other' <?php echo $major=='Other' ? 'selected':'' ?>>Other</option>
								</select>
								</div>
							</div>
							
							<div class="form-actions">
								<button type="submit" class="btn btn-primary">Save changes</button>
								<button class="btn">Cancel</button>
							</div>
						</fieldset>
						</form>
				
				</div>
			</div><!--/span-->
		
		</div><!--/row-->	

	</div><!--/.fluid-container-->
	<!-- end: Content -->
	</div><!--/#content.span10-->
	</div><!--/fluid-row-->

	<footer>
		<p>
			<span style="text-align:left;float:left">Copyright &copy; 2016.Company name All rights reserved.</span>
		</p>
	</footer>
	
	<!-- start: JavaScript-->

		<script src="js/jquery-1.9.1.min.js"></script>
		<script src="js/jquery-migrate-1.0.0.min.js"></script>
	
		<script src="js/jquery-ui-1.10.0.custom.min.js"></script>
	
		<script src="js/jquery.ui.touch-punch.js"></script>
	
		<script src="js/modernizr.js"></script>
	
		<script src="js/bootstrap.min.js"></script>
	
		<script src="js/jquery.cookie.js"></script>
	
		<script src='js/fullcalendar.min.js'></script>
	
		<script src='js/jquery.dataTables.min.js'></script>

		<script src="js/excanvas.js"></script>
		<script src="js/jquery.flot.js"></script>
		<script src="js/jquery.flot.pie.js"></script>
		<script src="js/jquery.flot.stack.js"></script>
		<script src="js/jquery.flot.resize.min.js"></script>
	
		<script src="js/jquery.chosen.min.js"></script>
	
		<script src="js/jquery.uniform.min.js"></script>
		
		<script src="js/jquery.cleditor.min.js"></script>
	
		<script src="js/jquery.noty.js"></script>
	
		<script src="js/jquery.elfinder.min.js"></script>
	
		<script src="js/jquery.raty.min.js"></script>
	
		<script src="js/jquery.iphone.toggle.js"></script>
	
		<script src="js/jquery.uploadify-3.1.min.js"></script>
	
		<script src="js/jquery.gritter.min.js"></script>
	
		<script src="js/jquery.imagesloaded.js"></script>
	
		<script src="js/jquery.masonry.min.js"></script>
	
		<script src="js/jquery.knob.modified.js"></script>
	
		<script src="js/jquery.sparkline.min.js"></script>
	
		<script src="js/counter.js"></script>
	
		<script src="js/retina.js"></script>

		<script src="js/custom.js"></script>
	<!-- end: JavaScript-->
	
</body>
</html>
