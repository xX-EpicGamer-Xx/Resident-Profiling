<?php
if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "residents";

    $connection = new mysqli($servername ,$username, $password, $database); // create connection
    $sql = "DELETE FROM residents WHERE id=$id";
    $connection->query($sql);
}
header("location: /accounts/index.php");
exit;
?>
