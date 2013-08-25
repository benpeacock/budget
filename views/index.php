<?php
require_once '../controllers/init.inc.php';
require_once 'header.inc.php';
echo 'This is the home page for users who are not logged in.';
?>

<!--  CREATE user form -->
<h2>Sign Up (Create New User):</h2>
<form action="user.php" method="post">
<ul>
<input type="hidden" name="action" value="create" />
<li>first name: <input type="text" name="first_name" id="first_name" /></li>
<li>last name: <input type="text" name="last_name" id="last_name" /></li>
<li>username: <input type="text" name="username" id="username" /></li>
<li>password: <input type="text" name="password" id="password" /></li>
<li>confirm pw: <input type="text" name="password_twice" id="password_twice" /></li>
<li><input type="submit" name="submit" id="submit" /></li>
</ul>
</form>
<?php require_once 'footer.inc.php'; ?>