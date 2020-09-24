<?php
require_once '../init/init.php';

Session::delete('user_role');
Session::delete('username');
Session::delete('user');

header('location:../index.php');