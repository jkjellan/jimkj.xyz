<div>
    <?php
        print "You sold " . $sell_info[0]["shares"] . " share(s) of " . 
        $sell_info[0]["name"] . " at $" . $sell_info[0]["price"] .
        " per share, for cash value of $" .  $sell_info[0]["value"]
    ?>; 
</div>