<?php
declare(strict_types=1);

namespace MeowBlog\View\Helper;

use Cake\View\Helper;
use Cake\View\View;

/**
 * Shortcodes helper
 */
class ShortcodesHelper extends Helper
{
    /**
     * Default configuration.
     *
     * @var array<string, mixed>
     */
    protected $_defaultConfig = [];

    public function hello(string $name): string
    {
        $start = "<h2 id='hello'>";
        $end = "</h2>";

        return $start . $name . $end;
    }

    public function appVersion(): string
    {
        return "1.0.0";
    }
}
