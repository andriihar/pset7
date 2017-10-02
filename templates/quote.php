<?php
    print ("A share of  ". $name."  (".$symbol.")  "."costs ". "$".number_format($price, 2, '.', '') );
?>
<div style="height: 20px"></div>
<form action="/" method="post">
	<fieldset>
			<div class="form-group">
			<button type="submit" class="btn btn-default">Back</button>
		</div>
	</fieldset>
</form>