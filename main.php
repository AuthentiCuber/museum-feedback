<?php

require "dbdetails.php";

$name = "";
$wherefrom = "";
$comment = "";

function cleanInput(string $data) : string {
    // Remove whitespace from ends
    $trimmed = trim($data);
    // Remove backslashes to prevent escape characters
    $stripped = stripslashes($trimmed);
    // Convert all special characters to html entities to 
    // prevent script injection
    $sanitised = htmlspecialchars($stripped);
    return $sanitised;
}

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
        <title>Feedback</title>
    </head>
    <body>
        <header>
            <img src="assets/images/MDMLogo.png" alt="Motueka District Museum Logo">
        </header>
        <main>
            <h1>Visitor Feedback</h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" 
                  method="post">
                <label for="name">What is your name?</label>
                <input type="text" id="name" name="name">

                <label for="wherefrom">Where are you from?</label>
                <input type="text" id="wherefrom" name="wherefrom">

                <label for="comment">Let us know what you thought of your visit!</label>
                <textarea id="comment" name="comment" rows="4" cols="40"></textarea>
                <br>
                <input type="submit" name="submit" value="Submit">
            </form>

            <section>
                <h2>Previous feedback</h2>
                <?php

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = cleanInput($_POST["name"]);
                    $wherefrom = cleanInput($_POST["wherefrom"]);
                    $comment = cleanInput($_POST["comment"]);

                    $insert = "INSERT INTO Feedback (name, wherefrom, comment) VALUES ('$name', '$wherefrom', '$comment')";
                    $conn->query($insert);
                    
                    echo "<q>$comment</q><br>";
                }

                if ($name != "") {
                    echo "$name<br>";
                }
                if ($wherefrom != "") {
                    echo "$wherefrom";
                }

                ?>
            </section>
        </main>
    </body>