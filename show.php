<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width" />
    <title>Все сообщения</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <h2>Все сообщения</h2>
    <?php
    $conn = new mysqli("localhost", "root", "root", "messages");
    if($conn->connect_error){
    die("Ошибка: " . $conn->connect_error);
    }
    $sql = "SELECT * FROM allmess";
    if($result = $conn->query($sql)){
    $rowsCount = $result->num_rows; // количество полученных строк
    echo "<p>Получено объектов: $rowsCount</p>";
    echo "<table class='table table-condensed table-striped table-bordered'>
    <tr><th>UserName</th><th>Email</th><th>Homepage</th><th>Message</th><th>Ip</th><th>Browser</th><th>Date</th><th>File</th></tr>";
    foreach($result as $row){
        $filename=$row["filename"];
        $pattern_name = '/\*\.txt/';
        echo "<tr>";
            echo "<td>" . $row["username"] . "</td>";
            echo "<td>" . $row["email"] . "</td>";
            echo "<td>" . $row["homepage"] . "</td>";
            echo "<td>" . $row["text"] . "</td>";
            echo "<td>" . $row["ip"] . "</td>";
            echo "<td>" . $row["browser"] . "</td>";
            echo "<td>" . $row["date"] . "</td>";
            if($filename!=null && end(explode(".", $filename))=="txt"){
                echo "<td >" . $filename . "</td>";
            }
            else if($filename!=null ){
            echo "<td width=\"250\">" . "<img src=\"data/".$filename."\" alt=\"\" width=\"320\" height=\"240\">". "</td>";
            }
            
        echo "</tr>";
    }
    echo "</table>";
    $result->free();
    } else{
    echo "Ошибка: " . $conn->error;
    }
    $conn->close();
    ?>
    </body>