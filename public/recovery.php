<?php
// configuration
require("../includes/config.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
	if (!empty($_GET)){

		$hash = trim(htmlspecialchars($_GET['recovery']));

		// take row with GET hash from DB
		$result = query("SELECT * FROM recovery WHERE hash = ?", $hash);
		if (empty($result)){
			apologize("Wrong link!");
		} else if ( ($diff = strtotime($result[0]['expires']) - time()) > 0 ) {
			render("recovery_form.php", ["title" => "Recovery", "hash" => $hash]);
		} else {
			redirect('reset.php');
		}
	} else {
	// else render form
	render("recovery_form.php", ["title" => "Recovery"]);
	}
}
// else if user reached page via POST (as by submitting a form via POST)
else if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$password = (string) trim(htmlspecialchars($_POST["password"]));
	$confirmation = (string) trim(htmlspecialchars($_POST["confirmation"]));
	$hash = trim(htmlspecialchars($_POST["hash"]));


	if (empty($password) || (strlen($password) < 4)) {
		apologize("You must provide your new password or your password must contained more than 4 char.");
	} else if (empty($confirmation) || (strlen($confirmation) < 4)) {
		apologize("You must provide confirm new password or your password must contained more than 4 char.");
	}
	$rows = query("SELECT u.id as id, u.hash as hash FROM users as u, recovery WHERE recovery.user_id = u.id and recovery.hash = ?", $hash);

	if (count($rows) == 1) {
		// first (and only) row
		$row = $rows[0];

		if ($password !== $confirmation) {
				apologize("You password must mismatch.");
		}
		$sql = query("UPDATE users SET hash = ? WHERE id = ?", password_hash($password, PASSWORD_BCRYPT), $row['id']);
		$sql = query("DELETE FROM `recovery` WHERE user_id = ?", $row['id']);


		// redirect to portfolio

		redirect("login.php");

	}
}
