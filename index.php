<!-- 
    Matt Hogan
    INF 653
    To-Do List Assignment
 -->

<?php
    $newtitle = filter_input(INPUT_POST, "newtitle", FILTER_UNSAFE_RAW);
    $description = filter_input(INPUT_POST, "description", FILTER_UNSAFE_RAW);
    
    $title = filter_input(INPUT_GET, "title", FILTER_UNSAFE_RAW);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>To-Do List</title>
        <link rel="stylesheet" href="css/main.css" >
    </head>
    <body>
        <main>
            <header>
                <h1>To-Do List</h1>
            </header>
            <div class="scroll">
                <?php require("database.php"); ?>
                <?php 
                    $query = "SELECT * FROM todoitems";
                    $statement = $db->prepare($query);
                    $statement->execute();
                    $results = $statement->fetchAll();
                    $statement->closeCursor();
                ?>

                <?php if (!empty($results)) { ?>
                    <?php 
                        foreach ($results as $result) {
                            $itemnum = $result["ItemNum"];
                            $title = $result["Title"];
                            $description = $result["Description"];
                    ?>
                        <div class="item">
                            <div class="list-items">
                                <p class="title entry"><?php echo $title; ?></p>
                                <p class="description entry"><?php echo $description; ?></p>
                            </div>
                            <form class="delete" action="delete_record.php" method="POST">
                                <input type="hidden" name="itemnum" value="<?php echo $itemnum; ?>">
                                <button class="delete-button">X</button>
                            </form>
                        </div>
                    <?php } ?>
            </div>
            <?php } else { ?>
                <h2 class="no-items">No To-Do Items Exist Yet</h2>
            <?php } ?>

            <div id="additem">
                <h2 class="add-header">Add Item</h2>
                <form class="add" action="insert.php" method="POST">
                    <div class="inputs">
                        <input type="text" id="newtitle" name="newtitle" placeholder="Title" required>
                        <input type="text" id="description" name="description" placeholder="Description" required>
                    </div>
                    <button class="add-button">ADD ITEM</button>
                </form>
            </div>
        </main>
    </body>
</html>