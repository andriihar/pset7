<form action="recovery.php" method="post">
	<fieldset>
		<div class="form-group">
			<input class="form-control" name="hash"   placeholder="Email" type="text" hidden value="<?= $hash?>"/>
		</div>
		<div class="form-group">
			<input class="form-control" name="password" placeholder="New password" type="password"/>
		</div>
		<div class="form-group">
			<input class="form-control" name="confirmation" placeholder="Password" type="password"/>
		</div>
		<div class="form-group">
			<button type="submit" class="btn btn-default">Change</button>
		</div>
	</fieldset>
</form>
<div>
	or  <a href="login.php">log in</a>
</div>
