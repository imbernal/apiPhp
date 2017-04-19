<?php
// error reporting
error_reporting();

// set_default time_zone
date_default_timezone_set('America/New_York');

//page is the current page, if there's nothing set, default is page 1

$page = isset($_GET['page']) ? $_GET['page'] : 1;
