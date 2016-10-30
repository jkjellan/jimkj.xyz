<?php if (isset($stock)): ?>    
    
    <div> <?php print "A share of " . $stock["name"] . " (" . $stock["symbol"] . ") costs $" . $stock["price"] ?> </div>

<?php else: ?>

    <div> <?php print "Lookup function probably failed" ?> </div>

<?php endif ?>