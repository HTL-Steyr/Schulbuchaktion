<?php

use App\Kernel;

require_once dirname(__DIR__).'/vendor/autoload_runtime.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
if ($_SERVER["REQUEST_METHOD"] == "OPTIONS") {
    die("success");
}

return function (array $context) {
    return new Kernel($context['APP_ENV'], (bool) $context['APP_DEBUG']);
};
