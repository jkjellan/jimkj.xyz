<table class="table table-striped">

    <thead>
        <tr>
            <th>Transaction</th>
            <th>Date/Time</th>
            <th>Symbol</th>
            <th>Shares</th>
            <th>Price</th>
        </tr>
    </thead>
   
   <tbody>
        <?php
        foreach($transactions as $transaction)
        {
            print("<tr>");
            
            print("<td>" . $transaction["type"] . "</td>");
            print("<td>" . $transaction["datetime"] . "</td>");
            print("<td>" . $transaction["symbol"] . "</td>");
            print("<td>" . $transaction["shares"] . "</td>");
            print("<td>$" . $transaction["price"] . "</td>");
            
            print("</tr>");
        }
        ?>

</table>