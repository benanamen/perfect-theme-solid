<?php

declare(strict_types=1);

use PerfectApp\Http\Cookie;
use PerfectApp\ThemeSelector\ThemeSelector;

require_once '../vendor/autoload.php';

$cookie = new Cookie($_COOKIE);

$theme = new ThemeSelector($cookie);

if (!empty($_GET['theme'])) {
    $theme->setTheme($_GET['theme']);
    header('Location: ./');
    exit;
}
