<?php

namespace jakubenglicky\SocialPlugins;

use jakubenglicky\SocialPlugins\Twitter\Exception\InputException;

class Twitter
{
    /**
     * @var Helpers
     */
    private $helpers;

    /* Sizes */
    const SIZE_SMALL = 'small';
    const SIZE_LARGE = 'large';

    const SIZE_OPTIONS = [self::SIZE_SMALL,self::SIZE_LARGE];

    public function __construct()
    {
        $this->helpers = new Helpers();
    }

    public function renderJs()
    {
        return $this->helpers->latte->renderToString(__DIR__ . '/templates/twScript.latte');
    }

    public function renderTweetButton($size = self::SIZE_SMALL, $link = null)
    {
        if (!in_array($size, self::SIZE_OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if (!filter_var($link, FILTER_VALIDATE_URL) && $link != null || $link === '') {
            throw new InputException('Link must be in corrent format.', 500);
        }

        if ($link == null) {
            $link = $this->helpers->getUrl();
        }

        $parameters = array(
            "link" => $link,
            "size" => $size,
        );

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/twButton.latte', $parameters);
    }

    public function renderFollowButton($twitterLink, $size = self::SIZE_SMALL, $hideUsername = false, $hideFollowCount = true)
    {
        if (!filter_var($twitterLink, FILTER_VALIDATE_URL)) {
            throw new InputException('Twitter link must be in corrent format.', 500);
        }

        if ($twitterLink === '' || $twitterLink === 'NULL' || $twitterLink == null) {
            throw new InputException('Twitter link must be defined.', 500);
        }

        if (!in_array($size, self::SIZE_OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if (!is_bool($hideUsername) || !is_bool($hideFollowCount)) {
            throw new InputException('These values (hideUsername, hideFollowCount) must be boolean.', 500);
        }

        $parameters = array(
            "link" => $twitterLink,
            "size" => $size,
            "username" => ($hideUsername) ? 'false' : 'true',
            "count" => ($hideFollowCount) ? 'false' : 'true',
        );

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/twFollow.latte', $parameters);
    }
}
