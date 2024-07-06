<?php
session_start();
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Printing Resak</title>
		<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.6/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/sr-1.4.1/datatables.min.css" rel="stylesheet">
 
		<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
		<script src="https://cdn.datatables.net/v/bs5/jq-3.7.0/jszip-3.10.1/dt-2.0.6/af-2.7.0/b-3.0.2/b-colvis-3.0.2/b-html5-3.0.2/b-print-3.0.2/cr-2.0.1/date-1.5.2/fc-5.0.0/fh-4.0.1/kt-2.12.0/r-3.0.2/rg-1.5.0/rr-1.5.0/sc-2.4.2/sb-1.7.1/sp-2.3.1/sl-2.0.1/sr-1.4.1/datatables.min.js"></script>

		<style>
		body {
            background-image: url('pastel1.jpg');
			line-height: 1.6;
			padding: 2px;
            background-size: cover;
			text-align:center;
            background-repeat: no-repeat;
            background-attachment: fixed;
			background-size: 100%;
            font-family: Arial, sans-serif;
            color: #333;
        }
		.login-form {
			width: 340px;
			margin: 50px auto;
			font-size: 15px;
		}
		.login-form form {
			margin-bottom: 15px;
			background: #f7f7f7;
			box-shadow: 0px 2px 2px rgba(0,0,0,0.3);
			padding: 30px;
		}
		.login-form h2 {
			margin:0 0 15px;
		}
		.form-control, .btn {
			min-height: 38px;
			border-radius: 2px;
		}
		.btn {
			font-size: 15px;
			font-weight:bold;
		}
		</style>
	</head>
	<body>
	<div class="login-form">
		<form action="" method="post">
		<h2 class="text-center">Log in</h2>
		<div class="form-group">
			<input type="text" name="email" class="form-control" placeholder="Email"
			required="required">
		</div>
		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Password"
			required="required">
		</div>
		<div class="form-group">
			<input type="submit" name="login-btn" class="btn btn-primary btn-block" 
			value="Login"/> 
		</div>
		</form>
		<td><a class="btn btn-default" href="home">Home</a></td>
		
	<?php 
	$conn = mysqli_connect('localhost','root','','printing_resak');
		if(isset($_POST['login-btn'])){
			$email=$_POST['email'];
			$password=$_POST['password'];
		$select="SELECT * FROM user WHERE user_email='$email'";
		$run=mysqli_query($conn,$select);
		$row_user=mysqli_fetch_array($run);

		$db_email=$row_user['user_email'];
		$db_password=$row_user['user_password'];
			if($email==$db_email&&$password==$db_password){
				echo "<script>window.open('display.php','_self');</script>";
				$_SESSION['email']=$db_email;
			}else{
				echo "Email or Password is Wrong!";	
			}	
		}
	?>	
	
	</div>
	
	</body>
</html>	