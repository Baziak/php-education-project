<h2>Home page</h2>
<br>
<pre>

<?php
/*//var_dump($this->users);
ob_start();
session_start();
echo "id: ".($_SESSION['id']);*/
//var_dump($this->users);
if (!empty($_SESSION['id'])) {
echo "Добро пожаловать на сайт, ".$_SESSION['username']." !";
echo $_SESSION['id'];
}
?>
</pre>

