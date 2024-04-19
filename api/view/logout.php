<?php

session_start();

session_destroy();

header("Location: ../controller/news.php");
exit();

?>