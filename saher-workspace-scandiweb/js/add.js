$(document).ready(function(){

    $("#productType").on("change",function(){
          if ($('select').val() == 'Book'){
             $("#attributes").html(`
                <label>Weight (KG)</label>
                <input type="text" name="weight" id="weight" />
                <p class='description'>Please, provide weight.</p>
             `);
            }
            else if($("select").val() == 'DVD') {
                $("#attributes").html(`
                    <label>Size (MB)</label>
                    <input type="text" name="size" id="size" />
                    <p class='description'>Please, provide size.</p>                
                `)
            }
            else {
                $("#attributes").html(`
                    <label>Height (CM)</label>
                    <input type="text" name="height" id="height" />
                    <label>Width (CM)</label>
                    <input type="text" name="width" id="width" />
                    <label>Length (CM)</label>
                    <input type="text" name="length" id="length" />
                    <p class='description'>Please, provide dimensions.</p>                
                `)
            }
    });
    $("#submit").click(function() {

        var productData = {sku: $("#sku").val(), name: $("#name").val(), price: $("#price").val(), type: $('select').val(), attribute: ""};
        if(productData.sku == "" || productData.name == "" || productData.price == "") {
            $("#validator").html(`<p class='error'>Please fill all empty fields.</p>`);
            return false;  
        }
        if (productData.type == null) {
            $("#validator").html(`<p class='error'>Please choose type of product.</p>`);
            return false;
        }
        if (isNaN(productData.price)) {
            $("#validator").html(`<p class='error'>Price has to be a valid number. (If you're using a comma, use a dot instead)</p>`);
            return false;
        }
        if (productData.price >= 1000) {
            $("#validator").html(`<p class='error'>Maximum allowed price is 999$.</p>`);
            return false;
        }
        switch(productData.type) {
            case 'Book':
                productData.attribute = $("#weight").val();
                if (productData.attribute == "") {
                    $("#validator").html(`<p class='error'>Please fill all empty fields.</p> `);
                    return false;
                }
                if (isNaN(productData.attribute)) {
                    $("#validator").html(`<p class='error'>Weight has to be a valid number. (If you're using a comma, use a dot instead)</p>`);
                    return false;
                }
                break;
            case 'DVD':
                productData.attribute = $("#size").val();
                if (productData.attribute == "") {
                    $("#validator").html(`<p class='error'>Please fill all empty fields.</p>`);
                    return false;
                }
                if (isNaN(productData.attribute)) {
                    $("#validator").html(`<p class='error'>Size has to be a valid number. (If you're using a comma, use a dot instead)</p>`);
                    return false;
                }
                break;
            case 'Furniture':
                dimensions = {height: $("#height").val(), width: $("#width").val(), length: $("#length").val()};
                if (dimensions.height == "" || dimensions.width == "" || dimensions.length == "") {
                    $("#validator").html(`<p class='error'>Please fill all empty fields.</p>`);
                    return false;
                }
                if (isNaN(dimensions.height) || isNaN(dimensions.width) || isNaN(dimensions.length)) {
                    $("#validator").html(`<p class='error'>Dimensions have to be valid numbers. (If you're using a comma, use a dot instead)</p>`);
                    return false;
                }
                var formattedDimensions = dimensions.height + "x" + dimensions.width + "x" + dimensions.length;
                productData.attribute = formattedDimensions;
                break;
            default:
                break;
        }
        $.ajax({
            type: "POST",
            url: "addproduct.php",
            data: {data: JSON.stringify(productData)},
            success: function(response) {
                var data = JSON.parse(response);
                if (data.code == 404) {
                    $("#validator").html(`<p class='error'>SKU already exists.</p>`); 
                }
                else {
                    window.location.href='/';
                }
            }
        });
    });
});