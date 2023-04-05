<?php

declare(strict_types=1);

namespace PerfectApp\ThemeSelector;

use PerfectApp\Http\Cookie;

class ThemeSelector
{
    private Cookie $cookie;

    /**
     * @var array<string, string>
     */
    private array $themes = [
        'default' => 'Default',
        'cerulean' => 'Cerulean',
        'cosmo' => 'Cosmo',
        'cyborg' => 'Cyborg',
        'darkly' => 'Darkly',
        'flatly' => 'Flatly',
        'journal' => 'Journal',
        'litera' => 'Litera',
        'lumen' => 'Lumen',
        'lux' => 'Lux',
        'materia' => 'Materia',
        'minty' => 'Minty',
        'morph' => 'Morph',
        'pulse' => 'Pulse',
        'quartz' => 'Quartz',
        'sandstone' => 'Sandstone',
        'simplex' => 'Simplex',
        'sketchy' => 'Sketchy',
        'slate' => 'Slate',
        'solar' => 'Solar',
        'spacelab' => 'Spacelab',
        'superhero' => 'Superhero',
        'united' => 'United',
        'vapor' => 'Vapor',
        'yeti' => 'Yeti',
        'zephyr' => 'Zephyr',
    ];

    public function __construct(Cookie $cookie)
    {
        $this->cookie = $cookie;
    }

    public function getTheme(): ?string
    {
        $themeName = $this->cookie->get('theme') ?? 'default';

        if (!isset($this->themes[$themeName])) {
            $themeName = 'default';
        }

        return $themeName;
    }

    public function setTheme(string $themeName): void
    {
        if (!isset($this->themes[$themeName])) {
            $themeName = 'default';
        }

        $expire = time() + (60 * 60 * 24 * 30); // 30 days from now
        $this->cookie->set('theme', $themeName, $expire, '/');
    }

    public function renderSelector(): string
    {
        $currentTheme = $this->getTheme();
        $output = '<div class="theme-selector">';
        $output .= '<label for="theme-select">Select a theme:</label>';
        $output .= '<select id="theme-select" name="theme">';

        foreach ($this->themes as $themeKey => $themeName) {
            $selected = ($themeKey === $currentTheme) ? 'selected' : '';
            $output .= "<option value='$themeKey' $selected>$themeName</option>";
        }

        $output .= '</select>';
        $output .= '</div>';
        return $output;
    }
}
