<?php
// configuration
require("../includes/config.php");

// if user reached page via GET (as by clicking a link or via redirect)
if ($_SERVER["REQUEST_METHOD"] == "GET") {

			// else render form
		render("reset_form.php", ["title" => "Reset"]);

}// else if user reached page via POST (as by submitting a form via POST)
else if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$email = filter_var(trim(htmlspecialchars($_POST['email'])),FILTER_VALIDATE_EMAIL);

	if (empty($email)) {
		apologize("You must provide your email.");
	}
	$result = query("SELECT * FROM users WHERE email = ?", $email);

	if (empty($result)) {
		apologize("Invalid email");
	} else {

		//make expires period
		$date = new DateTime();
		$date->add(new DateInterval('PT3600S'));
		$date = $date->format('Y-m-d H:i:s');

		// make link
		$hash = hash('md5', mt_rand().time());
		$link = 'http://'. $_SERVER['HTTP_HOST']. "/recovery.php?recovery={$hash}";

		$sql = query("INSERT INTO recovery (user_id, hash, expires) values (?, ?, ?)",
			$result[0]['id'], $hash, $date);

		//TODO send to link to mail

			//render('confirm.php');
		redirect($link);
	}
}
