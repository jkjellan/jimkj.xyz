<div>
    <?php
        print "You bought " . $buy_info[0]["shares"] . " share(s) of " . 
        $buy_info[0]["name"] . " for $" . $buy_info[0]["price"] .
        " per share, costing you $" .  $buy_info[0]["value"]
    ?>;
</div>