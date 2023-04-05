<?php
declare(strict_types=1);

namespace Unit\ThemeSelector;

use PerfectApp\Http\Cookie;
use PerfectApp\ThemeSelector\ThemeSelector;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\MockObject\Exception;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

#[CoversClass(ThemeSelector::class)]
class ThemeSelectorTest extends TestCase
{
    private ThemeSelector $themeSelector;

    /**
     * @throws Exception
     */
    protected function setUp(): void
    {
        parent::setUp();

        // create a mock Cookie object
        $cookie = $this->createMock(Cookie::class);

        // set up the mock to return 'darkly' as the theme when get() is called
        $cookie->method('get')
            ->with('theme')
            ->willReturn('darkly');

        // set up the mock to set the 'theme' cookie when set() is called
        $cookie->method('set')
            ->with(
                $this->equalTo('theme'),
                $this->anything(),
                $this->greaterThanOrEqual(time()),
                $this->equalTo('/')
            );

        // create the ThemeSelector object with the mock Cookie object
        $this->themeSelector = new ThemeSelector($cookie);
    }

    /**
     * @throws Exception
     */
    private function createThemeSelector(string $initialTheme = 'default'): ThemeSelector
    {
        $cookieMock = $this->createMock(Cookie::class);
        $cookieMock->method('get')->willReturn($initialTheme);
        return new ThemeSelector($cookieMock);
    }

    /**
     * @throws Exception
     */
    public function testGetValidTheme(): void
    {
        $themeSelector = $this->createThemeSelector('darkly');
        $this->assertSame('darkly', $themeSelector->getTheme());
    }

    /**
     * @throws Exception
     */
    public function testGetThemeInvalidTheme(): void
    {
        $themeSelector = $this->createThemeSelector('invalid_theme');
        $this->assertSame('default', $themeSelector->getTheme());
    }

    /**
     * @throws Exception
     */
    public function testSetTheme(): void
    {
        $themeSelector = $this->createThemeSelector('cosmo');
        $this->assertSame('cosmo', $themeSelector->getTheme());
    }

    public function testSetThemeInvalidName(): void
    {
        $cookie = $this->getMockBuilder(Cookie::class)
            ->disableOriginalConstructor()
            ->getMock();

        $themeSelector = new ThemeSelector($cookie);

        // Pass an invalid theme name to setTheme()
        $themeSelector->setTheme('invalid_theme');

        // Verify that the theme has been set to "default"
        $this->assertSame('default', $themeSelector->getTheme());
    }

    public function testRenderSelector(): void
    {
        $reflection = new ReflectionClass(ThemeSelector::class);
        $themesProperty = $reflection->getProperty('themes');
        $themesProperty->setAccessible(true);
        $themes = $themesProperty->getValue($this->themeSelector);

        $output = $this->themeSelector->renderSelector();
        $this->assertStringContainsString('<div class="theme-selector">', $output);
        $this->assertStringContainsString('<label for="theme-select">Select a theme:</label>', $output);
        $this->assertStringContainsString('<select id="theme-select" name="theme">', $output);

        // check that each theme is an option
        foreach ($themes as $themeKey => $themeName) {
            $this->assertStringContainsString('<option value="' . $themeKey . '"', $output);
            $this->assertStringContainsString($themeName, $output);
        }
    }
}
