<?php

    // configuration
	require("../includes/config.php");

	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		$symbol = trim(htmlspecialchars($_POST["symbol"]));

		//query the Yahoo price
		if  (empty($symbol)) {
			apologize('You have not any stocks');
		}
		$stock = lookup($symbol);

		// check for returned nothing
		if ($stock === false) {
			apologize("Entered stock symbol was invalid.");
		}

		$rows = query("SELECT symbol, stocks FROM portfolio WHERE id = ? and symbol = ? ", $_SESSION["id"], $symbol);
		if (count($rows) == 1) {
			$shares = $rows[0]["stocks"];
		} else {
			apologize("Shares for specified symbol not found.");
		}

		// value
		$value = $stock["price"] * $shares;

		$query = query("DELETE FROM portfolio where id = ? and symbol = ?", $_SESSION["id"], $symbol);
		if ($query === false) {
			apologize("Error while selling shares.");
		}

		// Update users cash
		$query = query("UPDATE users SET cash = cash + ? where id = ?", $value, $_SESSION["id"]);
		if ($query === false) {
			apologize("Error while selling shares.");
		} else {
			$query = query("INSERT INTO history (`symbol`, `stocks`, `action`, `price`, `user_id`) VALUES (?,?,?,?,?)",
				strtoupper($stock["symbol"]), $shares, 'Sell', $stock["price"], $_SESSION["id"]);
		}

		redirect("/");

	} else 	{
			// Fill the array of user shares
			$rows = query("SELECT symbol FROM portfolio WHERE id = ?", $_SESSION["id"]);
			render("sell_form.php", ["title" => "Sell", "symbols" => $rows]);
	  }
