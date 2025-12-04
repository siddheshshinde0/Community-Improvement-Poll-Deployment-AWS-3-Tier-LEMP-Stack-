<?php
// RDS Database Configuration
$servername = "YOUR_RDS_ENDPOINT";  
$username   = "admin";              
$password   = "YOUR_PASSWORD";      
$dbname     = "pollDB";             

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collect selected vote
$vote = $_POST['vote'];

// Insert vote into database
$sql = "INSERT INTO votes (choice) VALUES ('$vote')";

if ($conn->query($sql) === TRUE) {
    echo "
    <div style='
        font-family: Arial; 
        padding: 40px; 
        background: #f4f4f4; 
        text-align: center; 
        border-radius: 10px;
        width: 400px;
        margin: 100px auto;
        border: 1px solid #ddd;
    '>
        <h2 style='color:#333;'>Thank you for voting!</h2>
        <p>Your response has been recorded successfully.</p>
        <a href='index.html' style='
            display:inline-block;
            margin-top:20px;
            padding:10px 20px;
            background:#333;
            color:white;
            text-decoration:none;
            border-radius:6px;
        '>Go Back</a>
    </div>";
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>