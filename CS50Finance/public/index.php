<?php

    // configuration
    require("../includes/config.php"); 

    $id = $_SESSION["id"];
    
    $port_rows = CS50::query("SELECT * FROM portfolio  WHERE user_id = $id");
    $user_rows = CS50::query("SELECT * FROM users  WHERE id = $id");
    
    
    $positions = [];
    foreach ($port_rows as $port_row)
    {
        $stock = lookup($port_row["symbol"]);
        
        
        $total = $stock["price"] * $port_row["shares"];
        $total = number_format($total,2);
        $stock["price"] = number_format($stock["price"],2);
        
        
        if ($stock !== false)
        {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "shares" => $port_row["shares"],
                "symbol" => $port_row["symbol"],
                "total" => $total
            ];
        }
        
    }
    
    $cash = $user_rows[0]["cash"];
    $cash = number_format($cash,2);
    
    // render portfolio
    render("portfolio.php", ["positions" => $positions,"title" => "Portfolio","cash" => $cash]);

?>