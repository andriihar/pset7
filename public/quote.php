<?php

 // configuration
    require("../includes/config.php");

    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // else render form
        render("quote_form.php", ["title" => "quote"]);
    } else if ($_SERVER["REQUEST_METHOD"] == "POST") {
    	$quote = trim(htmlspecialchars($_POST["quote"]));

        if (empty($quote)) {
            apologize("You must provide a symbol.");
        } else {
            $stock = lookup($quote);
            if(!empty($stock)) {
                render("quote.php", ["name" => $stock["name"], "symbol" => $stock["symbol"], "price" => $stock["price"]]);
            } else {
                apologize("Not stocks for this symbol");
            }
        }
    }
