<?php
/*

*/

require("../includes/config.php");
$id = $_SESSION["id"];

$user_rows = CS50::query("SELECT * FROM users WHERE id = $id");
    

if($_SERVER["REQUEST_METHOD"] == "GET")
{
    render("myaccount_form.php", ["title" => "My Account"]);
}
    
elseif($_SERVER["REQUEST_METHOD"] == "POST")
{
    $cash = $_POST["addcash"];
    
    if(preg_match("/^\d+$/", $cash) == false)
    {
        apologize("Input amount as a whole dollar integer");
    }
    
    
    $account_info[] =
    [
        
    "cash" => number_format($cash,2),    
    
    ];
    
    
    $Cash = CS50::query("UPDATE users SET cash = (cash + $cash) WHERE id = $id");
    $History= CS50::query("INSERT INTO history (user_id, type, datetime, symbol, shares, price) VALUES($id,'DEPOSIT',NOW(),'CASH','',$cash)");
    
   render("myaccount_view.php", ["title" => "Deposit Confirmation", "account_info" => $account_info]);
    
}



?>