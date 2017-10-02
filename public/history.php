<?php
require("../includes/config.php");
// render portfolio

$history = [];
$rows = query ("SELECT * FROM history WHERE user_id = ? ORDER BY id DESC", $_SESSION["id"]);
if ($rows === false) {
	apologize("Error for reading history");
} else {
	foreach ($rows as $row) {
		$history[] = [
			"action" => $row["action"],
			"price" => $row["price"],
			"stocks" => $row["stocks"],
			"symbol" => $row["symbol"],
			"time" => $row["time"]
		];
	}
}
render("history.php", ["history" => $history,"title" => "History"]);


