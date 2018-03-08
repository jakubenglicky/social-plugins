<?php
/**
 * Part of jakubenglicky/social-plugins
 */

namespace jakubenglicky\SocialPlugins\Facebook\Options;

class Layout
{
    const BUTTON_COUNT = 'button_count';
    const BOX_COUNT = 'box_count';
    const BUTTON = 'button';
    const STANDARD = 'standard';

    const FOLLOW_LAYOUT_OPTIONS = [
        self::BUTTON_COUNT,
        self::BUTTON,
        self::BOX_COUNT,
        self::STANDARD
    ];

    const SHARE_LAYOUT_OPTIONS = [
        self::BUTTON_COUNT,
        self::BUTTON,
        self::BOX_COUNT
    ];
}
