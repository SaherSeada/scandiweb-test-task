$(document).ready(function(){

    $('#deleteButton').click(function() {
        var deletedProducts = [];
        var products = document.getElementsByClassName("delete-checkbox");
        for (let i = 0; i < products.length; i++) {
            if(products[i].checked) {
                deletedProducts.push(products[i].name);
            };
        }
        if (deletedProducts.length != 0) {
            $.ajax({
                type: "POST",
                url: "/index.php",
                data: {data: deletedProducts},
                success: function() {
                    window.location.reload();
                }
            });
        }
    });
});