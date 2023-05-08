<html>
    <head>
        <title>Product List</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/delete.js"></script>
        <link href="style.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div class='header'>
            <h1> Product List </h1>
            <button class="greenButton" onclick="window.location.href = 'addproduct.php'">
                ADD
            </button>
            <button class="redButton" id="deleteButton">
                MASS DELETE
            </button>
        </div>
        
        <div id='list'>
            <ul>
            <?php
            require('Database.php');
            $database = new Database();
            $database->displayProducts();
            if (isset($_POST['data'])) {
                $database->deleteFromDatabase($_POST['data']);
            }
            ?>
            </ul>
        </div>
        <footer>Scandiweb Test Assignment</footer>
    </body>
</html>