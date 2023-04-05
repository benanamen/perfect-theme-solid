<?php

declare(strict_types=1);

namespace Unit\Cookie;

use PerfectApp\Http\Cookie;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(Cookie::class)]
class CookieTest extends TestCase
{
    private Cookie $cookie;

    protected function setUp(): void
    {
        $this->cookie = new Cookie([]);
    }

    public function testSetCookie(): void
    {
        $this->cookie->set('test_cookie', 'test_value', time() + 3600, '/');
        $this->assertSame('test_value', $this->cookie->get('test_cookie'));
    }

    public function testGetCookie(): void
    {
        $_COOKIE['test_cookie'] = 'test_value';
        $cookie = new Cookie($_COOKIE);

        $value = $cookie->get('test_cookie');
        $this->assertSame('test_value', $value);

        $value = $cookie->get('invalid_cookie');
        $this->assertNull($value);
    }

    public function testGetCookieReturnsNullWhenCookieIsNotSet(): void
    {
        $this->assertNull($this->cookie->get('nonexistent_cookie'));
    }

    public function testGetCookieReturnsCookieValueWhenCookieIsSet(): void
    {
        $expectedValue = 'test_value';
        $cookie = new Cookie(['test_cookie' => $expectedValue]);
        $this->assertSame($expectedValue, $cookie->get('test_cookie'));
    }

    public function testSetCookieSetsCookieWithValue(): void
    {
        $name = 'test_cookie';
        $value = 'test_value';
        $expire = time() + 3600;
        $path = '/';
        $this->cookie->set($name, $value, $expire, $path);

        $this->assertSame($value, $this->cookie->get($name));
    }

    public function testDeleteRemovesCookie(): void
    {
        $name = 'test_cookie';
        $value = 'test_value';
        $path = '/';
        $this->cookie->set($name, $value, time() + 3600, $path);

        $this->cookie->delete($name, $path);

        $this->assertNull($this->cookie->get($name));
    }
}
