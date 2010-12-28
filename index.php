<?php
date_default_timezone_set('Europe/London');
require_once '../../ppi/init.php';
$app = new PPI_App();
$app->boot()->dispatch();
