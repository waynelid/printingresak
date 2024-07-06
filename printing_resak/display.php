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

// Update item
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $telephone_number = $_POST['telephone_number'];
    $pickup_date = $_POST['pickup_date'];
    $document_type = $_POST['document_type'];
    $image = $_FILES['image']['name'];
    $target = "images/" . basename($image);

    $sql = "UPDATE item SET id='$id',name='$name', telephone_number='$telephone_number', pickup_date='$pickup_date', document_type='$document_type', image='$image' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $msg = "Image uploaded successfully";
        } else {
            $msg = "Failed to upload image";
        }
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

// Delete item
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $sql = "DELETE FROM item WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printing Resak</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	
	<style>
        body {
            background-image: url('pastel1.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-attachment: fixed;
            font-family: Arial, sans-serif;
            color: #333;
        header {
			background-color: #E5D0E3;
			color: #000000;
			padding: 10px 0;
		}
		ul {
			list-style-type: none;
			margin: 0;
			padding: 0;
			overflow: hidden;
			background-color: #C5A3FF;
		}

		li {
			float: left;
		}

		li a {
			display: block;
			color: white;
			text-align: center;
			padding: 16px 25px;
			text-decoration: none;
		}
		
		li a:hover:not(.active) {
            background-color: #ddd;
        }
		
		.container {
			position: center;
			justify-content: space-between;
            width: 70%;
            margin:  auto;
            background: rgba(255, 255, 255, 0.8);
			text-align: center;
            padding: 50px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);		
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
<body>
		<header>
			<h1>Welcome to Printing Resak</h1>
			<ul>
				<li><a href="home.html"/>Home</a></li>
				<li><a href="about.html"/>About</a></li>
				<li><a href="contact.html"/>Contact</a></li>
			</ul>

		</header>
		<br>
		<br>
<div class="container">
    <h2 class="mt-4">Item Management</h2>

    <!-- Filter Form -->
    <form method="post" class="form-inline mb-3">
        <input type="text" name="filter" class="form-control mr-2" placeholder="Search" value="<?php echo $filter; ?>">
        <button type="submit" class="btn btn-primary">Search</button>
    </form>

    <!-- Items Table -->
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Telephone Number</th>
                <th>Pickup Date</th>
                <th>Document Type</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
 <?php 
	while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['telephone_number']; ?></td>
                <td><?php echo $row['pickup_date']; ?></td>
                <td><?php echo $row['document_type']; ?></td>
				<td><img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['image'];?>" height="30" width="260">
				</td>
                <td>
                    <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-info">Edit</a>
                    <a href="?delete=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
		<td><a class="btn btn-info" href="index.php">Home</a></td>
</div>
<br>
<br>
		<footer>
			<p>&copy; 2024 Printing Resak. All rights reserved.</p>
		</footer>
</body>
</html>

