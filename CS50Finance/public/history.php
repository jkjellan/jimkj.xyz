<?php
require("../includes/config.php");
$id = $_SESSION["id"];

$history_rows = CS50::query("SELECT * FROM history WHERE user_id = $id");

$transactions = [];

foreach($history_rows as $history_row)
{
    $transactions[] =
    [
        "type" => $history_row["type"],
        "datetime" => $history_row["datetime"],
        "symbol" => $history_row["symbol"],
        "shares" => $history_row["shares"],
        "price" => number_format($history_row["price"],2),
        "user_id" => $history_row["user_id"],
        "id" => $history_row["id"]
    ];
}

render("history_view.php", ["title" => "History","transactions" => $transactions]);


?>