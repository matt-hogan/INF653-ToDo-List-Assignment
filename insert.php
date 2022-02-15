<?php
ob_start();

require("database.php");

$itemnum = filter_input(INPUT_POST, "itemnum", FILTER_VALIDATE_INT);
$newtitle = filter_input(INPUT_POST, "newtitle", FILTER_UNSAFE_RAW);
$description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);

if ($newtitle) {
    $query = "INSERT INTO todoitems (Title, Description)
            VALUES (:newtitle, :description)";
    $statement = $db->prepare($query);
    $statement->bindValue(":newtitle", $newtitle);
    $statement->bindValue(":description", $description);
    $statement->execute();
    $statement->closeCursor();
}

require("index.php");

header("Location: index.php");
ob_end_flush();