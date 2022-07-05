<?php
session_start();
unset($_SESSION['key']);
header("location: ../index.php");
