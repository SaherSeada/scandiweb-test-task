<?php
    require('Database.php');
    if (isset($_POST['data'])) {
        $database = new Database();
        if ($database->addToDatabase($_POST['data'])) {
            die((json_encode(array('code' => 200))));
        }
        else {
            die((json_encode(array('code' => 404))));
        }
    }
?>

<html>
    <head>
        <title>Product Add</title>
        <link href="style.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
        <script src="js/add.js"></script>
    </head>
    <body>
        <div class='header'>
            <h1> Product Add </h1>
            <button class="redButton" onclick="window.location.href = '/'">
                Cancel
            </button>
        </div>
        <div>
            <form id="product_form">
    	        <div>
    		        <label>SKU</label>
    		        <input type="text" name="sku" id="sku" />
    	        </div>
    	        <div>
    		        <label>Name</label>
    		        <input type="text" name="name" id="name" />
    	        </div>
    	        <div>
    		        <label>Price ($)</label>
    		        <input type="text" name="price" id="price" />
    	        </div>
                <div>
                    <label>Type Switcher</label>
                    <select name="TypeSwitcher" id="productType">
                        <option value="none" selected disabled hidden>Type Switcher</option>
                        <option id="DVD" value="DVD"> DVD </option>
                        <option id="Book" value="Book"> Book </option>
                        <option id="Furniture" value="Furniture"> Furniture </option>
                    </select>
                </div>
                <div id='attributes'>

                </div>
                <div>
                <input id='submit' type='button' value="Save"></input>
                </div>
                <div id='validator'>

                </div>
            </form>
  </div>
        <footer>Scandiweb Test Assignment</footer>
    </body>
</html>