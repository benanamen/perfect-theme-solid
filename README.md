[![codecov](https://codecov.io/gh/benanamen/perfect-flash-solid/branch/master/graph/badge.svg?token=0WL0Ifp3bA)](https://codecov.io/gh/benanamen/perfect-flash-solid)
[![Build](https://github.com/benanamen/perfect-theme-solid/actions/workflows/build.yml/badge.svg)](https://github.com/benanamen/perfect-theme-solid/actions/workflows/build.yml)

[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=coverage)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=reliability_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=security_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=sqale_rating)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=bugs)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=vulnerabilities)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)

[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Duplicated Lines (%)](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=duplicated_lines_density)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=sqale_index)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=benanamen_perfect-theme-solid&metric=code_smells)](https://sonarcloud.io/summary/new_code?id=benanamen_perfect-theme-solid)


## Overview:
ThemeSelector is a PHP class that enables the user to select and apply different themes to their web application. The available themes are predefined and are listed in a dropdown menu for selection.

### Usage:
To use ThemeSelector in your PHP project, follow these steps:

1. Create an instance of ThemeSelector by passing a Cookie object as an argument to its constructor.
2. Call the renderSelector method to generate the HTML code for the dropdown menu.
3. Display the generated HTML code to the user in your web application.
4. Check for POST request and call the `setTheme` method

### Example Usage:
Here is an example of how to use ThemeSelector in your PHP project:

Create a Cookie object  
```php
$cookie = new PerfectApp\Http\Cookie();
```

Create an instance of ThemeSelector  
```php
$themeSelector = new PerfectApp\ThemeSelector\ThemeSelector($cookie);
```

Generate & Display the HTML code for the dropdown menu  
```php
<form method="POST">
    <?php echo $theme->renderSelector(); ?>
    <button type="submit">Switch Theme</button>
</form>
```

Example Usage
```php
<?php

declare(strict_types=1);

use PerfectApp\Http\Cookie;
use PerfectApp\ThemeSelector\ThemeSelector;

require_once '../vendor/autoload.php';

$cookie = new Cookie($_COOKIE);

$theme = new ThemeSelector($cookie);

if (!empty($_POST['theme'])) {
    $theme->setTheme($_POST['theme']);
    header('Location: ./');
    exit;
}
```

### API:
The following methods are available in the ThemeSelector class:

    __construct(Cookie $cookie): This is the constructor method that takes a Cookie object as an argument. It initializes the $cookie property of the ThemeSelector object.

    getTheme(): This method returns the current theme name that is stored in the cookie. If there is no theme stored in the cookie, it returns the default theme.

    setTheme(string $themeName): This method sets the theme name in the cookie. If the theme name is not valid, it sets the default theme.

    renderSelector(): This method generates the HTML code for the dropdown menu that lists all the available themes. It returns the generated HTML code as a string.

Available Themes:
The following themes are available in ThemeSelector:

    Default
    Cerulean
    Cosmo
    Cyborg
    Darkly
    Flatly
    Journal
    Litera
    Lumen
    Lux
    Materia
    Minty
    Morph
    Pulse
    Quartz
    Sandstone
    Simplex
    Sketchy
    Slate
    Solar
    Spacelab
    Superhero
    United
    Vapor
    Yeti
    Zephyr

Note:
Please make sure to include the PerfectApp\Http\Cookie class in your project to use ThemeSelector