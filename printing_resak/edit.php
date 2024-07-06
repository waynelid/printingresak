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

// Fetch the item details
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM item WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "No record found";
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

    if (!empty($image)) {
        $target = "images/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
    } else {
        $image = $row['image'];
    }

    $sql = "UPDATE item SET name='$name', telephone_number='$telephone_number', pickup_date='$pickup_date', document_type='$document_type', image='$image' WHERE id=$id";

    if ($conn->query($sql) === TRUE) {
        header('Location: display.php');
        exit;
    } else {
        echo "Error updating record: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Item</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h2 class="mt-4">Edit Item</h2>

    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="telephone_number">Telephone Number:</label>
            <input type="text" class="form-control" id="telephone_number" name="telephone_number" value="<?php echo $row['telephone_number']; ?>" required>
        </div>
        <div class="form-group">
            <label for="pickup_date">Pickup Date:</label>
            <input type="date" class="form-control" id="pickup_date" name="pickup_date" value="<?php echo $row['pickup_date']; ?>" required>
        </div>
        <div class="form-group">
            <label for="document_type">Document Type:</label>
            <input type="text" class="form-control" id="document_type" name="document_type" value="<?php echo $row['document_type']; ?>" required>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control" id="image" name="image">
            <img src="images/<?php echo $row['image']; ?>" alt="<?php echo $row['name']; ?>" width="100">
        </div>
        <button type="submit" name="update" class="btn btn-success">Update Item</button>
        <a href="index.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
