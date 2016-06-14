<?php
session_start();
//produces a string with session name, used mostly for testing
echo "My usernamename is " . $_SESSION["username"] . ".<br>";

?>