
    
  <?php
$fname = "";
$password = "";
$err = "";
//database connection
$conn = mysqli_connect("localhost", "root", "", "db");

if (isset($_POST['login'])) {
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $sql = "select * from users where firstname='".$fname."' and password='".$password."' limit 1";
    $result = mysqli_query($conn, $sql);
    if (empty($fname)) {
        $err = "username is required!";
    } else if (empty($password)) {
        $err = "password is required!";
    } else if (mysqli_num_rows($result) === 1) {
        echo "success"; // This will be the response for AJAX
        exit();
    } else {
        $err = "username or password is incorrect";
    }
    echo $err; // This will be the response for AJAX
    exit();
  
}
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./css/login.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<div class="box">
    <h1>Login here</h1>
    <div class="err" id="error-message">
        <!-- Error messages will be displayed here -->
    </div>
    <form id="loginForm" method="post">
        <input type="text" name="fname" id="fname" placeholder="Enter username">
        <input type="password" name="password" id="password" placeholder="Enter password">
        <input type="submit" value="Login" name="login">
        Not yet a member? <a href="signup.php" style="color: #ffc107;">Signup</a>
    </form>
</div>

<script>  
    
    ///Ajax
    
$(document).ready(function() {
    $('#loginForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the form from submitting normally

        var fname = $('#fname').val();
        var password = $('#password').val();

        $.ajax({
            url: 'login.php',
            type: 'POST',
            data: {
                fname: fname,
                password: password,
                login: true
            },
            success: function(response) {
                if (response === "success") {
                    window.location.href = 'home.php'; // Redirect on success
                } else {
                    $('#error-message').text(response); // Display error message
                }
            }
        });
    });
});
</script>
</body>
</html></div>
</body>
</html>