<?php
    // Start Session
    session_start();
    // Close useless warning notificaiton
    error_reporting(E_ERROR); 
    ini_set("display_errors","Off");
?>

<!DOCTYPE html>
<html>
<head>
    
    <title>shopping cart</title>
</head>
<script type="text/javascript">
    function checkout(){
        
        document.getElementById('clearBtn').disabled = true;
        parent.closeMap();
        return true;
    }
    
    </script>
<body>
<?php
    // get info from db
    $server = "localhost";
    $user = "potiro";
    $password = "pcXZb(kL";
    $database = "poti";
    
    $connection = mysqli_connect($server, $user, $password,$database);
    if ($conn->connect_error) {
        die("cannot link to database:" . mysqli_connect_error());
    }
    $query = "SELECT * FROM products WHERE product_id=".$_SESSION['id'].";";
    $result = mysqli_query($connection,$query);
    $num_rows=mysqli_num_rows($result);
    
    if($num_rows>0){
        $product = mysqli_fetch_assoc($result); 
    }
    
    $id = $product[product_id];
    $name = $product[product_name];
    $price = $product[unit_price];
    $u_quan = $product[unit_quantity];
    $b_quan = $_POST['quantity'];
    $amount = $b_quan*$price;
    $product_in_cart = 0;
    $Total = 0;
    
    //initialization 
    if(empty($_SESSION['cart'])){
        // when cart is empty
        $array_temp = array(array($id,$name,$price,$u_quan,$b_quan,$amount));
        $_SESSION['cart'] = $array_temp;
    }else{
        // there are something in cart
        $exist = false;
        for($i=0;$i<count($_SESSION['cart']);$i++){
            if($_SESSION['cart'][$i][0]== $id){
                $exist =true;
                $_SESSION['cart'][$i][4] += $b_quan;
                $_SESSION['cart'][$i][5] += $amount;
                break;
            }
        }
        if($exist == false){
            $array_temp = array($id,$name,$price,$u_quan,$b_quan,$amount);
            $_SESSION['cart'][] = $array_temp;
        }
    }
    mysqli_close($connection);
?>
    <b>Shopping Cart</b>
    <table align="center" width=90%>
        <tr>
            <td>
                <b>Product ID</b>
            </td>
            <td>
                <b>Product Name</b>
            </td>
            <td>
                <b>Unit Price</b>
            </td>
            <td>
                <b>Unit Quantity</b>
            </td>
            <td>
                <b>Purchase</b>
            </td>
            <td>
                <b>Amount</b>
            </td>
        </tr>
        <tr>
            <?php
                foreach($_SESSION['cart'] as $good){
                    $product_in_cart += $good[4];
                    $Total += $good[5];
                    echo "<tr>";
                    echo "<td>".$good[0]."</td>";
                    echo "<td>".$good[1]."</td>";
                    echo "<td> $ ".$good[2]."</td>";
                    echo "<td>".$good[3]."</td>";
                    echo "<td>".$good[4]."</td>";
                    echo "<td> $ ".$good[5]."</td>";
                    echo "</tr>";
                }
                $_SESSION['totalProduct']=$product_in_cart;
                $_SESSION['totalPrice']=$Total;
            ?>
        </tr>
        <tr>
            <br>
        </tr>
        <tr>
            <td>Products:</td>
            <td colspan="2"><?php echo $product_in_cart ?> </td>
            <td>Total:</td>
            <td colspan="2"><?php echo "$ ".$Total ?> </td>
        </tr>
        <tr><td colspan="3"><form action="clear.php" method="post">
            <button type="submit" id="clearBtn">Clear</button>
            </form></td>
            <td colspan="3"><form action="checkout.php" method="post" target="right_top" onsubmit="return checkout();">
            <button type="submit">Check out</button>
            </form></td>
        </tr>
    </table>
    
</body>
</html>