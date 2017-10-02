<?php

// configuration
require("../includes/config.php");
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	// else render form
	render("buy_form.php", ["title" => "Buy"]);

} else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$symbol = trim(htmlspecialchars($_POST["symbol"]));
	$stocks = (int) trim(htmlspecialchars($_POST["stocks"]));

	if ($stocks === 0) {
		apologize("Wrong count of stocks.");
	}
	if (empty($symbol))	{
		apologize("You must provide a symbol.");
	} else 	{
		$stock = lookup($symbol);
		if(!empty($stock)) {
			if (!preg_match("/^\d+$/", $stocks)) {
				apologize("You must buy integer count");
			} else {
				$shares = $stocks;
				$value = $stock["price"] * $shares;

				$row =  query("SELECT cash FROM users WHERE id = ?", $_SESSION["id"]);
				$cash = $row[0]["cash"];

				if ($cash <= $value) {
					apologize("you have no money for this count of stocks");
				} else {
					$query = query("INSERT INTO portfolio (id, symbol, stocks) VALUES(?, ?, ?) 
						  ON DUPLICATE KEY UPDATE stocks = stocks + {$shares}", $_SESSION["id"], strtoupper($stock["symbol"]), $shares);

					if ($query === false) {
						apologize("Error while buy shares.");
					}
					$query = query("UPDATE users SET cash = cash - ? where id = ?", $value, $_SESSION["id"]);

					if ($query === false) {
						apologize("Error while buy shares.");
					} else {
						$query = query("INSERT INTO history (`symbol`, `stocks`, `action`, `price`, `user_id`) VALUES (?,?,?,?,?)", strtoupper($stock["symbol"]), $shares, 'buy', $stock["price"], $_SESSION["id"]);
					}
				}
			}
		} else {
			apologize("Not stocks for this symbol");
		}
		redirect('/');
	}
}
