<?php
	session_start();
	require_once('./connect.php');
	if(isset($_SESSION['login'])){
		if($_SESSION['login']){
			?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/opensanslight.css" />
	<link rel = "stylesheet" href="css/style.css" type="text/css">
	<title>PC Care | Dashboard</title>
</head>
<body>
	<div class="container-fluid">
		<div id="head-navbar">
			<div id="logo" class="menu inline">
				<h3 style="margin:0px;">PC Care | Dashboard</h3>
			</div>
			<div class="menu inline pull-right">
				<a class="btn btn-info" href="logout.php">Logout</a>
			</div>
		</div>
		<section id="home-main" class="row">
		<?php 
			if(isset($_SESSION['username'])){
				$query = "SELECT id, firstname, lastname, age, username FROM users WHERE username='".$_SESSION['username']."'";
				$result = mysqli_query($con, $query);
				$row = mysqli_fetch_assoc($result);
				$id = $row['id']; 
				$admin = $_SESSION['admin'];
				$username = $row['username'];
				$age = $row['age'];
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
				?>

				<div id="home-main-left" class="col-sm-8">
				
					<div class="panel panel-default">
						<div class="panel-heading">
							<!-- <a data-toggle="collapse" href="#collapse1" class="heading-collapsible" style="color:white;"> -->
								<?php 
									if($admin == 0) 
										echo $firstname."'s "; 
									else {
										echo "Admin | ";
									}
								?>

								Issues (Not Resolved) 
							<!-- </a> -->
						</div>
						<!-- <div id="collapse1" class="panel-collapse collapse"> -->
							<div class="panel-body">

							<?php
							if(isset($_SESSION['status'])){
									$status = $_SESSION['status'];
									unset($_SESSION['status']);
							}
							?>

							<p><?php if(isset($status))echo "Status : ".$status; ?></p>

							<?php
							if($admin == 1) {


								$query = "SELECT * FROM complaints WHERE resolved = 0;";
								$result = mysqli_query($con, $query);
								if(mysqli_num_rows($result)  == 0){
									echo "<h3>No Unresolved Issues Found</h3>";
								} else {
									
									$count =0;
									while($row = mysqli_fetch_assoc($result)){
										$count = $count +1;
										$query = 'SELECT firstname, lastname, age, username FROM users WHERE id = '.$row['user_id'].';';
										$rre = mysqli_query($con, $query);
										$issuerusername;
										$rr =0;
										if(mysqli_num_rows($rre) == 1){
											$rr = mysqli_fetch_assoc($rre);
											$issuerusername = $rr['username'];
											
											
										} 
										echo "<div class=\"panel panel-info\">";
										echo "<div class='panel-heading inside'>";
										echo "<a data-toggle='collapse' href='#collapse1a".$count."' class='heading-collapsible' style='color:black;'>";
										echo $row['heading']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$rr['firstname'].")&nbsp;&nbsp;&nbsp;(".$row['time'].")";
										echo "</a></div>";
										echo "<div id='collapse1a".$count."'' class='panel-collapse collapse'><div class='panel-body'><h4>".$row['subheading']."</h4>";
										echo "<p class=\"truncate panel-body\">".$row['text']."</p>";
										
										echo "<p>Written by <b>".$rr['firstname']." ".$rr['lastname']."</b>, Age ".$rr['age'].".</p>";
											echo "<p>".$row['time']."</p>";
										echo "<a class='btn btn-success' href=\"issue.php?issue=".$row['id']."\">Read More</a>&nbsp;";
										echo '<a class=\'btn btn-success\' href="editissue.php?issue='.$row['id'].'">Edit</a>&nbsp;';
										echo '<a class=\'btn btn-danger\' href="deleteissue.php?issue='.$row['id'].'">Delete</a>&nbsp;';
										echo '<a class=\'btn btn-danger\' style="float:right;" href="markissue.php?issue='.$row['id'].'&username='.$issuerusername.'">Mark Resolved</a>&nbsp;';
										echo "</div></div></div>";
									}
								}



							} else {
								$query = "SELECT * FROM complaints WHERE user_id = ".$id." AND resolved = 0;";
								$result = mysqli_query($con, $query);
								if(mysqli_num_rows($result)  == 0){
									echo "<h3>No Unresolved Issues Found</h3>";
								} else {
									
									$count =0;
									while($row = mysqli_fetch_assoc($result)){
										$count = $count +1;
										echo "<div class=\"panel panel-info\" >";
										echo "<div class='panel-heading inside'>";
										echo "<a data-toggle='collapse' href='#collapse1b".$count."' class='heading-collapsible' style='color:black;'>";
										echo $row['heading']."</a></div>";
										echo "<div id='collapse1b".$count."'' class='panel-collapse collapse'><div class='panel-body'><h4>".$row['subheading']."</h4>";
										echo "<p class=\"truncate panel-body\">".$row['text']."</p>";
										$query = 'SELECT firstname, lastname, age, username FROM users WHERE id = '.$row['user_id'].';';
										$rre = mysqli_query($con, $query);
										if(mysqli_num_rows($rre) == 1){
											$rr = mysqli_fetch_assoc($rre);
											echo "<p>Written by <b>".$rr['firstname']." ".$rr['lastname']."</b>, Age ".$rr['age'].".</p>";
											echo "<p>".$row['time']."</p>";
											
										} 

										echo "<a class='btn btn-success' href=\"issue.php?issue=".$row['id']."\">Read More</a>&nbsp;";
										echo '<a class=\'btn btn-success\' href="editissue.php?issue='.$row['id'].'">Edit</a>&nbsp;';
										echo '<a class=\'btn btn-danger\' href="deleteissue.php?issue='.$row['id'].'">Delete</a>&nbsp;';
										echo "</div></div></div>";
									}
								}
								
							}

							
							?>
							</div>
						<!-- </div> -->
					</div>

					<!-- Resolved -->
					<div class="panel panel-default">
						<div class="panel-heading">
						<!-- <a data-toggle="collapse" href="#collapse2" class="heading-collapsible" style="color:white;"> -->
							<?php 
								if($admin == 0) 
									echo $firstname."'s "; 
								else {
									echo "Admin | ";
								}
							?>

							Issues (Resolved) 
						</div>
						<!-- </a> -->
						<!-- <div id="collapse2" class="panel-collapse collapse"> -->
							<div class="panel-body">

							<?php
							if(isset($_SESSION['status'])){
									$status = $_SESSION['status'];
									unset($_SESSION['status']);
							}
							?>

							<p><?php if(isset($status))echo "Status : ".$status; ?></p>

							<?php
							if($admin == 1) {


								$query = "SELECT * FROM complaints WHERE resolved = 1;";
								$result = mysqli_query($con, $query);
								if(mysqli_num_rows($result)  == 0){
									echo "<h3>No Unresolved Issues Found</h3>";
								} else {
									
									$count =0;
									while($row = mysqli_fetch_assoc($result)){
										$count = $count +1;
										$query = 'SELECT firstname, lastname, age, username FROM users WHERE id = '.$row['user_id'].';';
										$rre = mysqli_query($con, $query);
										$issuerusername;
										$rr = 0;
										if(mysqli_num_rows($rre) == 1){
											$rr = mysqli_fetch_assoc($rre);
											$issuerusername = $rr['username'];
											
											
										} 
										echo "<div class=\"panel panel-info\">";
										echo "<div class='panel-heading inside'>";
										echo "<a data-toggle='collapse' href='#collapse2a".$count."' class='heading-collapsible' style='color:black;'>";
										echo $row['heading']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(".$rr['firstname'].")&nbsp;&nbsp;&nbsp;(".$row['time'].")";
										echo "</a></div>";
										echo "<div id='collapse2a".$count."'' class='panel-collapse collapse'><div class='panel-body'><h4>".$row['subheading']."</h4>";
										echo "<p class=\"truncate panel-body\">".$row['text']."</p>";

										echo "<p>Written by <b>".$rr['firstname']." ".$rr['lastname']."</b>, Age ".$rr['age'].".</p>";
											echo "<p>".$row['time']."</p>";
										echo "<a class='btn btn-success' href=\"issue.php?issue=".$row['id']."\">Read More</a>&nbsp;";
										echo '<a class=\'btn btn-success\' href="editissue.php?issue='.$row['id'].'">Edit</a>&nbsp;';
										echo '<a class=\'btn btn-danger\' href="deleteissue.php?issue='.$row['id'].'">Delete</a>&nbsp;';
										echo '<a class=\'btn btn-danger\' style="float:right;" href="unmarkissue.php?issue='.$row['id'].'&username='.$issuerusername.'">Mark Unresolved</a>&nbsp;';
										echo "</div></div></div>";
									}
								}



							} else {
								$query = "SELECT * FROM complaints WHERE user_id = ".$id." AND resolved = 1;";
								$result = mysqli_query($con, $query);
								if(mysqli_num_rows($result)  == 0){
									echo "<h3>No Unresolved Issues Found</h3>";
								} else {
									
									$count =0;
									while($row = mysqli_fetch_assoc($result)){
										$count = $count +1;
										echo "<div class=\"panel panel-info\">";
										echo "<div class='panel-heading inside'>";
										echo "<a data-toggle='collapse' href='#collapse2b".$count."' class='heading-collapsible' style='color:black;'>";
										echo $row['heading']."</a></div>";
										echo "<div id='collapse2b".$count."'' class='panel-collapse collapse'><div class='panel-body'><h4>".$row['subheading']."</h4>";
										echo "<p class=\"truncate panel-body\">".$row['text']."</p>";
										$query = 'SELECT firstname, lastname, age, username FROM users WHERE id = '.$row['user_id'].';';
										$rre = mysqli_query($con, $query);
										if(mysqli_num_rows($rre) == 1){
											$rr = mysqli_fetch_assoc($rre);
											echo "<p>Written by <b>".$rr['firstname']." ".$rr['lastname']."</b>, Age ".$rr['age'].".</p>";
											echo "<p>".$row['time']."</p>";
											
										} 

										echo "<a class='btn btn-success' href=\"issue.php?issue=".$row['id']."\">Read More</a>&nbsp;";
										echo '<a class=\'btn btn-success\' href="editissue.php?issue='.$row['id'].'">Edit</a>&nbsp;';
										echo '<a class=\'btn btn-danger\' href="deleteissue.php?issue='.$row['id'].'">Delete</a>&nbsp;';
										echo "</div></div></div>";
									}
								}
								
							}

							
							?>
							</div>
						<!-- </div> -->
					</div>
				</div>
				<div class="col-sm-4">
					<?php 
						if($_SESSION['admin'] == 0) {
					?>
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-heading">
								Register a New Issue
							</div>
							<div class="panel-body">
								<p>Let us assist you through are professional support.</p>
								<p></p>
								<p><a class="btn btn-danger" href="newissue.php">New Issue</a></p>
							</div>
						</div>
					</div>
					<?php 
						}
					?>
					<div class="row">
						<div class="panel panel-default">
							<div class="panel-heading">
								Details
							</div>
							<div class="panel-body">
								<p>Full Name - <?php echo $firstname.' '.$lastname;?></p>
								<p>Age - <?php echo $age; ?></p>
								<p>Username - <?php echo $username; ?></p>
								<p><a href="editdetails.php">Edit Details</a> | <a href= "editpassword.php">Edit Password</a></p>
							</div>
						</div>
					</div>
				</div>
				<?php

			} else {
				header("Location: logout.php");
				exit();
			}
		?>
		</section>
	</div>		
				<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
</body>
</html>


			<?php
		}
	} else {
		$_SESSION['wrong'] = "You are logged out.";
		header("Location: index.php");
		exit();
	}

?>