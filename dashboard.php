<?php

require "dbdetails.php";

$conn = new mysqli($server_name, $username, $password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function InsertDeleteButton(int $id) : void {
    echo "<td>";
    echo "<input type=submit name=$id value='Delete'>";
    echo "</td>";
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
                  method="post">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>From</th>
                        <th>Comment</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // when any delete clicked, get corresponding id
                    $to_delete = intval(array_keys($_POST)[0]);
                    $delete = "DELETE FROM Feedback WHERE id = $to_delete";

                    $conn->query($delete);
                }

                $select = "SELECT id, name, wherefrom, comment, date FROM Feedback
                           ORDER BY id DESC";
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
                        // associate each delete button with the id
                        // of the corresponding entry
                        InsertDeleteButton($row["id"]);
                        echo "</tr>";
                    }
                }

                $conn->close()

                ?>
                </tbody>
            </table>
            </form>
        </main>
    </body>
</html>