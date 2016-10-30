<?php
/*

*/

require("../includes/config.php");
$id = $_SESSION["id"];


if($_SERVER["REQUEST_METHOD"] == "GET")
{
    $port_rows = CS50::query("SELECT * FROM portfolio WHERE user_id = $id");
    
    if($port_rows == false)
    {
        apologize("You don't have stocks to sell, bro");
    }
    
    render("sell_form.php", ["title" => "Sell"]);
}
    
elseif($_SERVER["REQUEST_METHOD"] == "POST")
{
    $symbol = strtoupper($_POST["symbol"]);

    $port_rows = CS50::query("SELECT * FROM portfolio WHERE user_id = $id AND symbol = '$symbol'");
    
    if($port_rows == false)
    {
        apologize("No shares available to sell. Choose another stock to sell");
    }

    $stock = lookup($port_rows[0]["symbol"]);
    
    if($stock == false)
    {
        apologize("You entered an invalid stock symbol");
    }
    
    $sell_info[] =
    [
    "name" => $stock["name"],
    "shares" => $port_rows[0]["shares"],
    "price" => number_format($stock["price"],2),
    "value" => number_format($stock["price"] * $port_rows[0]["shares"],2)
    ];
    
    $shares = $port_rows[0]["shares"];
    $price = number_format($stock["price"],2);
    $values = ($stock["price"] * $port_rows[0]["shares"]);
    
    $Delete = CS50::query("DELETE FROM portfolio WHERE user_id = $id AND symbol = '$symbol'");
    
    $History= CS50::query("INSERT INTO history (user_id, type, datetime, symbol, shares, price) VALUES($id,'SELL',NOW(),'$symbol',$shares,$price)");
    $Cash = CS50::query("UPDATE users SET cash = (cash + $values) WHERE id = $id");
    
    render("sell.php", ["title" => "Sale Confirmation", "sell_info" => $sell_info]);
    
}



?>