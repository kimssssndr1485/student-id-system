<?php
include 'classes/Auth.php';

Auth::logout();
header('Location: login.php');
exit;