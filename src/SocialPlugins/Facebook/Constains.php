<?php
/**
 * Part of jakubenglicky/social-plugins
 */

namespace jakubenglicky\SocialPlugins\Facebook;

class Constains
{
    /* Layouts */
    const LAYOUT_BUTTON_COUNT = 'button_count';
    const LAYOUT_BOX_COUNT = 'box_count';
    const LAYOUT_BUTTON = 'button';
    const LAYOUT_STANDARD = 'standard';

    const LIKE_FOLLOW_LAYOUT_OPTIONS = [
        self::LAYOUT_BUTTON_COUNT,
        self::LAYOUT_BUTTON,
        self::LAYOUT_BOX_COUNT,
        self::LAYOUT_STANDARD
    ];

    const SHARE_LAYOUT_OPTIONS = [
        self::LAYOUT_BUTTON_COUNT,
        self::LAYOUT_BUTTON,
        self::LAYOUT_BOX_COUNT
    ];


    /* Sizes */
    const SIZE_SMALL = 'small';
    const SIZE_LARGE = 'large';

    const SIZE_OPTIONS = [
        self::SIZE_SMALL,
        self::SIZE_LARGE
    ];

    /* Page Tabs */
    const PAGE_TIMELINE = 'timeline';
    const PAGE_EVENTS = 'events';
    const PAGE_MESSAGES = 'messages';

    const TABS_OPTIONS = [self::PAGE_TIMELINE, self::PAGE_EVENTS, self::PAGE_MESSAGES];
}
