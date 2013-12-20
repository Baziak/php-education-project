<h2>Home page</h2>
<br><pre>

<?php
var_dump($this->users);
ob_start();
session_start();
echo "Добро пожаловать на сайт, ".$_SESSION['username']." !";
ob_end_flush();
?>
</pre>

