<?php
$connect=mysqli_connect("localhost","root","","printing_resak");
$query="SELECT * FROM `item` WHERE 1";
$result=mysqli_query($connect, $query);
?>
<head>
    <meta charset="utf-8" />
    <title>Homepage</title>

	<style>
	.page {background-color:#E0BBE4; width:100%; margin:auto; padding:15px;}

    body {
            background-image: url('homepage.png');
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
	header {
			background-color: #E5D0E3;
			color: #000000;
			padding: 10px 0;
			text-align: center;
			width: 100%;
		}
    header, footer {
        background-color: #E5D0E3;
        padding: 15px;
    }
	nav ul {
			list-style: none;
		}
	nav ul li {
			display: inline;
			margin-right: 10px;
			position: relative;
		}
	nav a {
			text-decoration: none;
			color: #fff;
			padding: 10px 20px;
			
		}
	nav ul ul {
			position: absolute;
			top: 100%; /* Position just below the parent list item */
			left: 0;
			background: #333;
			display: none; /* Hide the dropdown by default */
		}
	nav ul ul li {
			display: block; /* Stack the dropdown items vertically */
		}
	nav li a:hover:not(.active) {
			background-color: #ddd;
		}
	.container {
			position: center;
			justify-content: space-between;
            width: 50%;
            margin:  auto;
            background-color: #E0BBE4;
			text-align: center;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 5px ;
        }
	footer {
			background-color:#E5D0E3; 
            color:#000000; 
			padding: 10px 0;
			position: center;
			text-align: center;
			width:100%;
			bottom: 0;
		}
	body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding:px;
        }
    header, footer {
            background-color: #D5AAFF;
            text-align: center;
            padding: 15px;
        } 
	</style>
</head>

<link rel="shortcut icon" type="image/jpg" href="faha printing.png">

<body>
    
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="container">
	<main role="main"> 
	
		
			
			<div class="post-blurb">
				<p><a><big><big><big><strong>WELCOME TO OUR WEBSITE</strong></big></big></big></a></p>
				<br>
				<button><a class="btn btn-primary" href="home.html">CLICK HERE</a></button>
			</div>
		
	</main>
		
	</div>
	
	<br>
	<br>
	<br>
	<br>
	<br>

</div> 
</body>
</html>