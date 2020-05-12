<?php

require_once 'libs/Application.php';

new Application();

echo '<pre>';
print_r($_SERVER);
print_r($tokens);
echo '</pre>';
die;