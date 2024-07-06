<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "printing_resak";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert item
if (isset($_POST['add'])) {
	$id = $_POST['id'];
    $name = $_POST['name'];
    $telephone_number = $_POST['telephone_number'];
    $pickup_date = $_POST['pickup_date'];
    $document_type = $_POST['document_type'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    $sql = "INSERT INTO item (id, name, telephone_number, pickup_date, document_type, image) VALUES ('$id','$name', '$telephone_number', '$pickup_date', '$document_type', '$image')";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}


// Fetch items
$filter = "";
if (isset($_POST['filter'])) {
    $filter = $_POST['filter'];
}
$sql = "SELECT * FROM item WHERE name LIKE '%$filter%' OR telephone_number LIKE '%$filter%' OR document_type LIKE '%$filter%'";
$result = $conn->query($sql);

$conn->close();
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

		
	</head>
	<body>
	<p><big><b>Add New Item</b></big></p>
    <!-- Add Item Form -->
    <form method="post" enctype="multipart/form-data" class="mb-3">
		<div class="form-group">
            <label for="name">Id:</label>
            <input type="text" class="form-control" id="id" name="id" required>
        </div>
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="telephone_number">Telephone Number:</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" required>
        </div>
        <div class="form-group">
            <label for="pickup_date">Pickup Date:</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" required>
        </div>
        <div class="form-group">
            <label for="document_type">Document Type:</label>
            <input type="text" class="form-control" id="document_type" name="document_type" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>
        <button type="submit" name="add" class="btn btn-success">Add Item</button>
		
    </form>
		
	<td><a class="btn btn-info" href="home.html">Back</a></td>
	<?php
		if (isset($_POST['insert-btn'])){
		$conn=mysqli_connect('localhost','root','','printing_resak');

		if(!$conn){
			die("Connection failed:".mysqli_connect_error());
		}
		
		$id=$_POST['id'];
		$name=$_POST['name'];
		$telephone_number=$_POST['telephone_number'];
		$pickup_date=$_POST['pickup_date'];	
		$document_type=$_POST['document_type'];
		
		
		//File Upload Handling
		$targetDir="uploads/";
		$targetFile=$targetDir.basename($_FILES["image"]["name"]);
		$uploadOk=1;
		$imageFileType=strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
		
		//Check if image file is an image or not
		$check=getimagesize($_FILES["image"]["tmp_name"]);
		if($check===false){
			echo "File is not an image.";
			$uploadOk=0;
		}
		
		//Check file size (limit to 5MB)
		if($_FILES["image"]["size"]>5000000){
			echo "Sorry, your file is too large.";
			$uploadOk=0;
		}	
		
		//Format image
		$allowedTypes=array("jpg","jpeg","png","gif");
		if(!in_array($imageFileType,$allowedTypes)){
			echo "Sorry, only JPG, JPEG, PNG and GIF files are allowed.";
			$uploadOk=0;
		}

		//Check if $uploadOk is set to 0 by an error
		if($uploadOk==0){
		echo "Sorry, your file was not uploaded.";
		}else{
			
			//Try to upload file 
			if(move_uploaded_file($_FILES["image"]["tmp_name"],$targetFile)){
				
				//File uploaded successfully
				$insert="INSERT INTO item(id, name, telephone_number, pickup_date, document_type,image)VALUES
				('$id','$name','$telephone_number','$pickup_date','$document_type','$targetFile')";
			
			if(mysqli_query($conn,$insert)){
				echo"<script>alert('Item added successfully');</script>";
				echo"<script>window.open('display.php','_self');</script>";
			}else{
				echo"Failed to insert data into database. Please try again.";
			}
			}else{
				echo"Sorry, there was an error uploading your file.";
			}
		}
		mysqli_close($conn);
		}
	?>
		
	</div>
	</body>

</html>

