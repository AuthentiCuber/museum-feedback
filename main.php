<?php

$name = "";
$wherefrom = "";
$comment = "";

function clean_input(string $data) : string {
    // Remove whitespace from ends
    $trimmed = trim($data);
    // Remove backslashes to prevent escape characters
    $stripped = stripslashes($trimmed);
    // Convert all special characters to html entities to 
    // prevent script injection
    $sanitised = htmlspecialchars($stripped);
    return $sanitised;
}

?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="styles/main.css">
        <title>Feedback</title>
    </head>
    <body>
        <header>
            <!-- Logo goes here -->
        </header>
        <main>
            <h1>Visitor Feedback</h1>
            <form action=<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?> 
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
                <p>
                <?php


                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $name = clean_input($_POST["name"]);
                    $wherefrom = clean_input($_POST["wherefrom"]);
                    $comment = clean_input($_POST["comment"]);
                }

                echo "$comment<br>";
                if ($name != "") {
                    echo "$name<br>";
                }
                if ($wherefrom != "") {
                    echo "$wherefrom";
                }

                ?>
                </p>
            </section>
        </main>
    </body>