
 <?php
session_start();

include("connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['user'];
    $friend = $_POST['friend'];
    $sql = "INSERT INTO friends(user, friend) VALUES ('$user', '$friend')";

    if (mysqli_query($conn, $sql)) {
        echo "data inserted";
    } else {
        echo "Error: ";
    }
    mysqli_close($conn);
        }
?>