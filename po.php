<?php
echo md5('admin');

?>
<form action="http://201.245.191.78/cacti/" method="post">
	<input type="hidden" name="action" 			value="login">
	<input type="text"   name="login_username" 	value="admin">
	<input type="text"   name="login_password" 	value="admin">
	<input type="text"   name="realm" 			value="admin">
	<input type="submit" name="enviar" value="enviar">
</form>