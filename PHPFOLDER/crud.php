<?php
// Initialize variables
$err = [];
$congra = "";

// Database connection
$conn = mysqli_connect("localhost", "root", "", "db");
if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Read (Fetch all users)
if (isset($_GET['action']) && $_GET['action'] == 'view') {
    $query = "SELECT * FROM users";
    $result = mysqli_query($conn, $query);
    $users = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $users[] = $row;
    }
}

// Update (Fetch user data for editing)
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "SELECT * FROM users WHERE id = $id";
    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) == 1) {
        $user = mysqli_fetch_assoc($result);
    } else {
        array_push($err, "User not found.");
    }
}

// Update (Handle form submission for editing)
if (isset($_POST['update'])) {
    $id = intval($_POST['id']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $sex = mysqli_real_escape_string($conn, $_POST['sex']);

    $query = "UPDATE users SET firstname = ?, lastname = ?, sex = ?, email = ? WHERE id = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "ssssi", $fname, $lname, $sex, $email, $id);

    if (mysqli_stmt_execute($stmt)) {
        $congra = "User updated successfully!";
    } else {
        array_push($err, "Update failed. Please try again.");
    }
    mysqli_stmt_close($stmt);
}

// Delete (Handle user deletion)
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = "DELETE FROM users WHERE id = $id";
    if (mysqli_query($conn, $query)) {
        $congra = "User deleted successfully!";
    } else {
        array_push($err, "Deletion failed. Please try again.");
    }
}
?>
<style>
    h1{
        text-align: center;
    }
    h2{
        text-align: center;
    }
    a{
        text-align: center;
    }
    body{
        background-color:rgba(0, 183, 244, 0.09);
    }
    table{
        margin: 0 auto;
    }
</style>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>
    <h1>User Management</h1>

    <!-- Display Errors -->
    <?php if (count($err) > 0): ?>
        <div style="color: red;">
            <?php foreach ($err as $error): ?>
                <p><?php echo $error; ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Display Success Message -->
    <?php if ($congra): ?>
        <div style="color: green;">
            <p><?php echo $congra; ?></p>
        </div>
    <?php endif; ?>

    <!-- View Users -->
    <h2>View Users <br><br>
    <a href="?action=view">View All Users</a>
    </h2>
    
   
    <?php if (isset($users)): ?>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Sex</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo $user['id']; ?></td>
                    <td><?php echo $user['firstname']; ?></td>
                    <td><?php echo $user['lastname']; ?></td>
                    <td><?php echo $user['sex']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td>
                        <a href="?action=edit&id=<?php echo $user['id']; ?>">Edit</a>
                        <a href="?action=delete&id=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>

    <!-- Edit User Form -->
    <?php if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($user)): ?>
        <h2>Edit User</h2>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <input type="text" name="fname" value="<?php echo $user['firstname']; ?>" required>
            <input type="text" name="lname" value="<?php echo $user['lastname']; ?>" required>
            <input type="email" name="email" value="<?php echo $user['email']; ?>" required>
            <input type="text" name="sex" value="<?php echo $user['sex']; ?>" required>
            <button type="submit" name="update">Update</button>
        </form>
    <?php endif; ?>
</body>
</html>