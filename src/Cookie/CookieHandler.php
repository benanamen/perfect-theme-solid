<?php

declare(strict_types=1);

namespace PerfectApp\Cookie;

trait CookieHandler
{
    public function set($name, $value, $expiry, $path): void
    {
        setcookie($name, $value, $expiry, $path);
        $_COOKIE[$name] = $value;
    }

    public function get($name)
    {
        return $_COOKIE[$name] ?? null;
    }
}
