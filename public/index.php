<?php

    // configuration
    require("../includes/config.php"); 
    // render portfolio

    $positions = [];
    $rows = query ("SELECT * FROM portfolio WHERE id = ?", $_SESSION["id"]);
    foreach ($rows as $row) {
        $stock = lookup($row["symbol"]);
        if ($stock !== false) {
            $positions[] = [
                "name" => $stock["name"],
                "price" => $stock["price"],
                "stocks" => $row["stocks"],
                "symbol" => $row["symbol"],
                "total" => $stock["price"] * $row["stocks"]
            ];
        }
    }
    $result = query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
    $cash = $result[0]["cash"];

    render("portfolio.php", ["positions" => $positions, "cash" => $cash,  "title" => "Portfolio"]);

?>
