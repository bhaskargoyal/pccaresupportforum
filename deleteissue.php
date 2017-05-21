<?php
	session_start();
	require_once('./connect.php');
	if(isset($_SESSION['login'])){
		if($_SESSION['login']){
			if(isset($_SESSION['username'])){

				if(isset($_POST['submit'])){
					$select = $_POST['select'];
					if($select == "no"){
						header("Location: home.php");
						exit();
					}
					if($_SESSION['admin'] == 1) {
						$query = "SELECT user_id from complaints WHERE id = ".$_SESSION['issueid'].";"; 
						$result1 = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result1);
						$userid = $row['user_id'];
					} else {
						$query = "SELECT id FROM users WHERE username = '".$_SESSION['username']."';";
						$result1 = mysqli_query($con, $query);
						$row = mysqli_fetch_assoc($result1);
						$userid = $row['id'];	
					}
					$query = "DELETE FROM complaints WHERE id ='".$_SESSION['issueid']."' AND user_id = ".$userid.";";
					$result = mysqli_query($con, $query);
					if($result == True){
						$_SESSION['status'] = "Successfully Deleted";
						header("Location: home.php");
						exit();
					} else {
						$_SESSION['status'] = "Unsuccessfull Delete";
						header("Location: home.php");
						exit();
					}

				} else {
					// create a form

					if(!isset($_GET['issue'])){
						header("Location: home.php");
						exit();
					}
					$_SESSION['issueid'] = $_GET['issue'];
					$query = "SELECT * FROM complaints WHERE id = ".$_SESSION['issueid'].";";
					$result = mysqli_query($con, $query);
					$row = mysqli_fetch_assoc($result);
				?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/opensanslight.css" />
	<link rel = "stylesheet" href="css/style.css" type="text/css">
	<title>PC Care | Delete Issue</title>
</head>
<body>
	<div class="container">
		<div id="head-navbar">
			<div id="logo" class="menu inline">
				<h3 style="margin:0px;">PC Care | Delete Issue</h3>
			</div>
			<div class="menu inline pull-right">
				<a class="btn btn-info" href="home.php">Back</a>
			</div>
		</div>
    
	    <div class="row give-top-margin">
			<div class="col-sm-2 col-sm-offset-5">
						<form method="post" action="deleteissue.php">
							<div class="form-group">
						        	<label for="select">Confirm </label>
						            <select name="select">
						            	<option value="no">No</option>
										<option value="yes">Yes</option>
									</select>
						        </div>
							<button type="submit" name="submit" class="btn btn-primary" value="submit">Delete Issue</button>
						</form>
							
			</div>
		</div>
	</div>
					<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
					</body>
					</html>
					<?php
				}
			} else {
				header("Location: logout.php");
				exit();
			}
		}
	} else {
		$_SESSION['wrong'] = "You are logged out.";
		header("Location: index.php");
		exit();
	}

?>