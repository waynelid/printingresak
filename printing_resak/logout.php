<?php
session_start();
$connect=mysqli_connect('localhost','root','','printing_resak');
$query="SELECT * FROM item ORDER BY ID DESC";
$result=mysqli_query($connect,$query);
	echo"<script>window.open('index.php','_self');</script>";
	session_destroy();
?>