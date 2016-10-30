<?php
/*

*/

require("../includes/config.php");
$id = $_SESSION["id"];

    $user_rows = CS50::query("SELECT * FROM users WHERE id = $id");
    $port_rows = CS50::query("SELECT * FROM portfolio WHERE user_id = $id");

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    if($user_rows[0]["cash"] == 0)
    {
        apologize("You don't have any money!");
    }
    render("buy_form.php", ["title" => "Buy"]);
}
    
elseif($_SERVER["REQUEST_METHOD"] == "POST")
{
    $symbol = strtoupper($_POST["symbol"]);
    $shares = $_POST["shares"];
    
    if(preg_match("/^\d+$/", $shares) == false)
    {
        apologize("Number of shares must be a non-negative integer");
    }

    $stock = lookup($symbol);
    
    if($stock == false)
    {
        apologize("You entered an invalid stock symbol");
    }
    
    $price = number_format($stock["price"],2);
    
    $buy_info[] =
    [
        
    "symbol" => $symbol,    
    "name" => $stock["name"],
    "shares" => $shares,
    "price" => number_format($stock["price"],2),
    "value" => number_format($stock["price"] * $shares,2)
    ];
    
    $values = ($stock["price"] * $shares);
    
    if($user_rows[0]["cash"] < $values)
    {
        apologize("You don't have enough money to purchase that stock");
    }
    
     if($user_rows[0]["cash"] < $shares)
    {
        apologize("You can't afford that, bro");
    }
    
    //$datetime = NOW();
    
    $Cash = CS50::query("UPDATE users SET cash = (cash - $values) WHERE id = $id");
    $History= CS50::query("INSERT INTO history (user_id, type, datetime, symbol, shares, price) VALUES($id,'BUY',NOW(),'$symbol',$shares,$price)");
    
   $Buy = CS50::query("INSERT INTO portfolio (user_id, symbol, shares) VALUES($id, '$symbol', $shares) ON DUPLICATE KEY UPDATE shares = (shares + $shares)");
   render("buy.php", ["title" => "Sale Confirmation", "buy_info" => $buy_info]);
    
}



?>