<?php
    // Start Session
    session_start();
    // Close useless warning notificaiton
    error_reporting(E_ERROR); 
    ini_set("display_errors","Off");
?>
<!DOCTYPE html>
<html >
<head>
    
    <title></title>
</head>

<body>
<?php
    $server = "localhost";
    $user = "potiro";
    $password = "pcXZb(kL";
    $database = "poti";
    
    $connection = mysqli_connect($server, $user, $password,$database);
    
    if ($conn->connect_error) {
        die("cannot link to database:" . mysqli_connect_error());
    }
    
    $query = "SELECT * FROM products WHERE product_id=$_GET[index];";
    $result = mysqli_query($connection,$query);
    
    $num_rows=mysqli_num_rows($result);
    echo "The information of products:";
    
    if($num_rows>0){
        $product = mysqli_fetch_assoc($result); 
    }
    $_SESSION['id']=$product[product_id];
    mysqli_close($connection);
?>
<table align="center" width=70%>
    <tr>
        <td>Product ID</td>
        <?php print "<td>".$product[product_id]."</td>"  ?>
    </tr>
    <tr>
        <td>Product Name</td>
        <?php print "<td>".$product[product_name]."</td>"  ?>
    </tr>
    <tr>
        <td>Unit Price</td>
        <?php print "<td>".$product[unit_price]."</td>"  ?>
    </tr>
    <tr>
        <td>Unit Quantity</td>
        <?php print "<td>".$product[unit_quantity]."</td>"  ?>
    </tr>
    <tr>
        <td>In Stock</td>
        <?php print "<td>".$product[in_stock]."</td>"  ?>
    </tr>
    <tr>
        <td>Quantity</td>
        <td align="left">
            <form action="shopping-cart.php"  target="right_btm" method="post" onsubmit="return check(<?php echo $product[in_stock]?>);">
                <input name="quantity" type="number" id="quantity" oninput="if(value.length>4)value=value.slice(0,4)">
                <input type="submit" name="add" value="add">
            </form>
        </td>
    </tr>
</table>
</body>
</html>

<script type="text/javascript">
    function check(stock){
        var quantity = document.getElementById("quantity").value;
        if (quantity == "" || quantity == 0){
            window.alert("Sorry, the amount need more than 1 !");
            return false;
        }
        if (isNaN(quantity)){
            window.alert("please input a valid amount!");
            return false;
        }
        if (quantity<0){
            window.alert("Please input a positive amount!");
            return false;
        }
        if (quantity>stock){
            window.alert("out of Stork! Please under the amount of stock!");
            return false;
        }
        return true;
    }
</script>