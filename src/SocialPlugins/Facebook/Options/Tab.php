<?php
/**
 * Part of jakubenglicky/social-plugins
 */

namespace jakubenglicky\SocialPlugins\Facebook\Options;

class Tab
{
    const TIMELINE = 'timeline';
    const EVENTS = 'events';
    const MESSAGES = 'messages';

    const OPTIONS = [
        self::TIMELINE,
        self::EVENTS,
        self::MESSAGES
    ];
}
