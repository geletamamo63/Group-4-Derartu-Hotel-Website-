<?php 
// Set up database credentials 
$servername = "localhost"; 
$username = "root"; 
$password = ""; 
$dbname = "db";

// Create a connection 
$conn= new mysqli($servername, $username, $password,$dbname); 
// Check connection 
if ($conn->connect_error) { 
die("Connection failed: " . $conn->connect_error); 
} 
// Close the connection 
echo "connected successfully" ;
?>