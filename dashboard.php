<?php

$server_name = "localhost";
$username = "root";
$password = "";
$db_name = "museumdb";

$conn = new mysqli($server_name, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="icon" href="assets/images/MDMLogo.png" type="image/x-icon">
        <link rel="stylesheet" href="styles/main.css">

        <title>Feedback Dashboard</title>
    </head>
    <body>
        <header>
            <img src="assets/images/MDMLogo.png" alt="Motueka District Museum Logo">
        </header>
        <main>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>From</th>
                        <th>Comment</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                $select = "SELECT id, name, wherefrom, comment, date FROM Feedback";
                $result = $conn->query($select);

                if ($result->num_rows > 0){
                    // iterate through rows
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["name"] . "</td>";
                        echo "<td>" . $row["wherefrom"] . "</td>";
                        echo "<td>" . $row["comment"] . "</td>";
                        echo "<td>" . $row["date"] . "</td>";
                        echo "</tr>";
                    }
                }

                $conn->close()

                ?>
                </tbody>
            </table>
        </main>
    </body>
</html>