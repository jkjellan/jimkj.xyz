<?php

    // configuration
    require("../includes/config.php"); 

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET")
    {
        // else render form
        render("quote_form.php", ["title" => "Quote"]);
    }
    
     else if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $stock = lookup($_POST["symbol"]);
         if ($stock === false)
        {
            apologize("Please input a valid stock symbol");
        }
        
        $stock["price"] = number_format($stock["price"],2);

        render("quote.php", ["title" => "Quote","stock" => $stock]);
        
    }
        
?>