<?php

namespace App\Helpers;

use League\CommonMark\CommonMarkConverter;

class MarkdownHelper {
    public static function render(string $text): string {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convert($text)->getContent();
    }
}
