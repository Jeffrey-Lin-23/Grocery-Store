<?php
    // Start Session
    session_start();
    // Close useless warning notificaiton
    error_reporting(E_ERROR); 
    ini_set("display_errors","Off");
?>

<?php
$to = $_POST[email];
$subject = "The Involce of Grocery Store";
$message ='<!DOCTYPE html><html><head><title></title></head><body>';
$message .= '<h1 align="middle">Thank you for your shopping!</h1>
    <table border="0" align="center" width=80%>
        <tr><h2 colspan="6" align="middle">Invoice</h2></tr>
        <tr><h4 align="middle" style="color:gray;">Grocery Store</h4></tr>
        <tr><td colspan="6" align="middle"><HR></HR></td></tr>
        <tr>
         <td>
                <b align="middle">Product ID</b>
            </td>
            <td>
                <b align="middle">Product Name</b>
            </td>
            <td>
                <b align="middle">Unit Price</b>
            </td>
            <td>
                <b align="middle">Unit Quantity</b>
            </td>
            <td>
                <b align="middle">Purchase</b>
            </td>
            <td>
                <b align="middle">Amount</b>
            </td>
        </tr>';
foreach($_SESSION['cart'] as $good){
    $message .= "<tr><td>".$good[0]."</td><td>".$good[1]."</td><td> $ ".$good[2]."</td><td>".$good[3]."</td><td>".$good[4]."</td><td> $ ".$good[5]."</td></tr>";
}
    $message .= '<tr><td colspan="6" align="middle"><HR></HR></td></tr>
        <tr><td colspan="5" align="right">Total:</td>';
    $message .= '<td>"$ "'.$_SESSION['totalPrice'].'</td></tr>';

$message .='</body></html>';

$headers = 'MIME-Version: 1.0'."\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";

mail($to,$subject,$message,$headers);
?>

<!DOCTYPE html>
<html lang="">
<head>
    <title>Purchase Succeed</title>
    <style>
        table{
             vertical-align:middle;
        }
    
    
    </style>
</head>

<body>
    <h1 align="middle">Purchase Succeed! The invoice is sent to your email!</h1>
    <table border="0" align="center" width=80%>
        <tr><h2 colspan="6" align="middle">Invoice</h2></tr>
        <tr><h4 align="middle" style="color:gray;">Grocery Store</h4></tr>
        <tr><td colspan="6" align="middle"><HR></HR></td></tr>
        <tr>
         <td>
                <b align="middle">Product ID</b>
            </td>
            <td>
                <b align="middle">Product Name</b>
            </td>
            <td>
                <b align="middle">Unit Price</b>
            </td>
            <td>
                <b align="middle">Unit Quantity</b>
            </td>
            <td>
                <b align="middle">Purchase</b>
            </td>
            <td>
                <b align="middle">Amount</b>
            </td>
        </tr>       
        
        
        <?php
                foreach($_SESSION['cart'] as $good){
                    echo "<tr>";
                    echo "<td>".$good[0]."</td>";
                    echo "<td>".$good[1]."</td>";
                    echo "<td> $ ".$good[2]."</td>";
                    echo "<td>".$good[3]."</td>";
                    echo "<td>".$good[4]."</td>";
                    echo "<td> $ ".$good[5]."</td>";
                    echo "</tr>";
                }
            ?>
        <tr><td colspan="6" align="middle"><HR></HR></td></tr>
        <tr><td colspan="5" align="right">Total:</td>
        <td><?php echo "$ ".$_SESSION['totalPrice'] ?></td>
        </tr>
    
    </table>
    
    
        
</body>
</html>
