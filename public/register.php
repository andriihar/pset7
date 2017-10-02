<?php
    // configuration
    require("../includes/config.php");

    // if user reached page via GET (as by clicking a link or via redirect)
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        // else render form
        render("register_form.php", ["title" => "Register"]);
    }
    // else if user reached page via POST (as by submitting a form via POST)
    else if ($_SERVER["REQUEST_METHOD"] == "POST") {

    	$username =  (string) trim(htmlspecialchars($_POST["username"]));
		$password = (string) trim(htmlspecialchars($_POST["password"]));
		$confirmation = (string) trim(htmlspecialchars($_POST["confirmation"]));
		$email = filter_var(trim(htmlspecialchars($_POST['email'])),FILTER_VALIDATE_EMAIL);

		// check form to correct data
		if (empty($username) || (strlen($username) < 2)) {
			apologize("You must provide your username or your username must contained more than 1 char.");
        }  else if (empty($password) || (strlen($password) < 4))  {
            apologize("You must provide your password or your password must contained more than 4 char.");
        } else if (empty($confirmation) || (strlen($confirmation) < 4)) {
            apologize("You must provide confirm password or your password must contained more than 4 char.");
        } else if ( empty($email)) {
			apologize("You must provide your email.");
		}

        if ($password !== $confirmation) {
            apologize("You password must mismatch.");
        }

        $result = query("SELECT * FROM users WHERE username = ?", $username);

        if (!empty($result)) {
            apologize("username is invalid");
        } else {
			$sql = query("INSERT INTO users (username, hash, cash, email) values (?, ?, 10000.0000, ?)",
						$username, password_hash($password, PASSWORD_BCRYPT), $email);
        }

        $rows = query ("SELECT LAST_INSERT_ID() AS id");
       if (empty($rows)) {
           apologize("Smth is going wrong!");
	   }
        $id = $rows[0]["id"];
        $_SESSION["id"] = $id;
        redirect("/");
    }
