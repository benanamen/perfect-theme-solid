<?php

declare(strict_types=1);

namespace PerfectApp\ThemeSelector;

use PerfectApp\Cookie\CookieHandler;

class ThemeSelector
{
    use CookieHandler;

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

    public function __construct()
    {
        $this->setTheme();
    }

    public function getTheme()
    {
        return $this->get('theme') ?? 'default';
    }

    public function setTheme($themeName = null): void
    {
        if ($themeName === null) {
            $themeName = $this->getTheme();
        }

        if (!isset($this->themes[$themeName])) {
            $themeName = 'default';
        }

        $expiry = time() + (60 * 60 * 24 * 30); // 30 days from now
        $this->set('theme', $themeName, $expiry, '/');
    }

    public function renderSelector(): string
    {
        $currentTheme = $this->getTheme();
        $output = '<div class="theme-selector">';
        $output .= '<label for="theme-select">Select a theme:</label>';
        $output .= '<select id="theme-select" name="theme">';

        foreach ($this->themes as $themeKey => $themeName) {
            $selected = ($themeKey === $currentTheme) ? 'selected' : '';
            $output .= '<option value="' . $themeKey . '" ' . $selected . '>' . $themeName . '</option>';
        }

        $output .= '</select>';
        $output .= '</div>';
        return $output;
    }
}
