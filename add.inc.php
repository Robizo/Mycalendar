<?php

    include_once 'dbh.inc.php';

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $datatime = $_POST['time'];
    $text =$_POST['note'];
    $sql = "INSERT INTO notes VALUES ( '$text' , '$datatime');";
    $result = $conn->query($sql);
    $sql = "SELECT * FROM notes";
    $result = $conn->query($sql);

   /* if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo $row['text']. "<br>";
        }
    } else {
        echo "0 results";
    }*/

   header("Location: calendar.php?signup=succes");
    