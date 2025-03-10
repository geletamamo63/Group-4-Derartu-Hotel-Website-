


    // If no errors, register the user
    if (count($err) === 0) {
        // Hash the password
        // $hashed_password = password_hash($pass1, PASSWORD_DEFAULT);

        // Insert user into the database using prepared statements
        $query = "INSERT INTO users (firstname, lastname, sex, email, password) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "sssss", $fname, $lname, $sex, $email, $pass1); // Fixed typo here

        if (mysqli_stmt_execute($stmt)) {
            $congra = "You are successfully registered! <a href='login.php' style='color: #ffc107;'>Login here</a>.";
        } else {
            array_push($err, "Registration failed. Please try again.");
        }
        mysqli_stmt_close($stmt);
    }
}
?>







<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/signup.css">
</head>
<body>
    <!-- Registration -->
    <nav>
        <div class="logo">
        <h1>DERARTU <br>HOTEL</h1>
        </div>
        <ul>
            <li><a href="">Home</a></li>
            <li><a href="">About</a></li>
            <li><a href="">Service</a></li>
            <li><a href="">Product</a></li>
            <li><a href="">Contact</a></li>
        </ul>
        <div class="menu-icon">
            <i class="fa fa-bars"></i>
        </div>
    </nav>
    <p> </p>
<div class="box2">
        <h1>signup here</h1>
        <div class="err">
            <?php
            include "err.php";
            ?>
        </div>
        <?php
            echo $congra;
            ?>
        
        <form action="signup.php" method="post">
        <input type="text" name="fname" id="" placeholder="enter first name" required>
        <input type="text" name="lname" id="" placeholder="enter last name" required>
        <input type="email" name="email" id="" placeholder="enter email" required>
        <label>sex</label>
        <input type="radio" name="sex" id="" value="male" required>male
        <input type="radio" name="sex" id="" value="male" required>female
        <input type="password" name="pass1" id="" placeholder="enter password"required>
        <input type="password" name="pass2" id="" placeholder="confirm password"required>
       
        <input type="submit" value="signup" name="signup">
        Already a member? <a href="login.php" style="color: #ffc107;">login</a>
        </form>
    </div>
</body>
</html>