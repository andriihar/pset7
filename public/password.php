<?php
// configuration
require("../includes/config.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	// else render form
	render("password_form.php", ["title" => "Password"]);
}
// else if user reached page via POST (as by submitting a form via POST)
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$password = (string) trim(htmlspecialchars($_POST["password"]));
	$new_password = (string) trim(htmlspecialchars($_POST["new_password"]));
	$confirmation = (string) trim(htmlspecialchars($_POST["confirmation"]));


	if (empty($password)) {
		apologize("You must provide your password.");
	} else if (empty($new_password) || (strlen($new_password) < 4)) {
		apologize("You must provide your new password or your password must contained more than 4 char.");
	} else if (empty($confirmation) || (strlen($confirmation) < 4)) {
		apologize("You must provide confirm new password or your password must contained more than 4 char.");
	}

	$rows = query("SELECT * FROM users WHERE id = ?", $_SESSION['id']);

	if (count($rows) == 1) {
		// first (and only) row
		$row = $rows[0];

		// compare hash of user's input against hash that's in database
		if (crypt($password, $row["hash"]) == $row["hash"]) {

			if ($new_password !== $confirmation) {
				apologize("You password must mismatch.");
			}
			$sql = query("UPDATE users SET hash = ? WHERE id = ?", password_hash($new_password, PASSWORD_BCRYPT), $_SESSION["id"]);
			// redirect to portfolio

			redirect("/");

		} else {
			apologize("Wrong password");
		}
	}
}
