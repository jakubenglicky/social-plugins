<?php

namespace SocialPlugins;

use SocialPlugins\Facebook\InputException;

class Facebook
{
    /**
     * @var \Latte\Engine
     */
    private $latte;

    /**
     * @var integer
     */
    private $appId;

    /**
     * @var string | 'cs_CZ'
     */
    private $locale;

    /**
     * @param string $appId
     */

    /* Layouts */
    const LAYOUT_BUTTON_COUNT = 'button_count';
    const LAYOUT_BOX_COUNT = 'box_count';
    const LAYOUT_BUTTON = 'button';
    const LAYOUT_STANDARD = 'standard';

    /* Sizes */
    const SIZE_SMALL = 'small';
    const SIZE_LARGE = 'large';

    /* Page Tabs */
    const PAGE_TIMELINE = 'timeline';
    const PAGE_EVENTS = 'events';
    const PAGE_MESSAGES = 'messages';

    public function __construct($appId)
    {
        $this->latte = new \Latte\Engine();
        $this->appId = $appId;

        $this->setLocale('cs_CZ');
    }

    /**
     * return string of html
     */
    public function renderInit()
    {
        $parameters = array(
            "appId" => $this->appId,
            "locale" => $this->locale,
        );

        $this->latte->render(__DIR__ . '/templates/fbRoot.latte', $parameters);
    }

    /**
     * @param string $link
     * @param integer $limit|5
     * @param integer $width|550
     * return string of html
     */

    public function renderComments($link, $limit = 5, $width = 550)
    {
        $parameters = array(
            "link" => $link,
            "limit" => $limit,
            "width" => $width,
        );

        $this->latte->render(__DIR__ . '/templates/fbComments.latte', $parameters);
    }

    /**
     * @param string $link
     * @param boolean $shareButton|false
     * @param string $layout|button_count
     * @param string $size|small
     * @param string $faces|false
     * return string of html
     */
    public function renderLikeButton($link, $shareButton = false, $layout = self::LAYOUT_BUTTON_COUNT, $size = self::SIZE_SMALL, $faces = false)
    {
        $parameters = array(
            "link" => $link,
            "layout" => $layout,
            "size" => $size,
            "share" => $shareButton,
            "faces" => $faces,
        );

        $this->latte->render(__DIR__ . '/templates/fbLike.latte', $parameters);
    }

    /**
     * @param string $link
     * @param string $layout|button_count
     * @param string $size|small
     * @param boolean $mobileFrame|false
     * return string of html
     */
    public function renderShareButton($link,$layout = self::LAYOUT_BUTTON_COUNT, $size = self::SIZE_SMALL,$mobileFrame = false)
    {
        $parameters = array(
            "link" => $link,
            "layout" => $layout,
            "size" => $size,
            "mobileFrame" => $mobileFrame,
        );

        $this->latte->render(__DIR__ . '/templates/fbShare.latte', $parameters);
    }

    /**
     * @param string $link
     * @param integer $width|200
     * @param string $size|small
     * @param boolean $layout|button_count
     * @param boolean $faces
     * return string of html
     */
    public function renderFollowButton($link, $width = 200, $size = self::SIZE_SMALL,$layout = self::LAYOUT_BUTTON_COUNT, $faces = false)
    {
        $parameters = array(
            "link" => $link,
            "layout" => $layout,
            "size" => $size,
            "faces" => $faces,
            "width" => $width,
        );

        $this->latte->render(__DIR__ . '/templates/fbFollow.latte', $parameters);
    }

    /**
     * @param string $fbPageLink
     * @param string $tabs
     * @param integer $width|350
     * @param integer $height|500
     * @param boolean $smallHeader|false
     * @param boolean $hideCoverPhoto|false
     * @param boolean $showFaces|false
     * return string of html
     */
    public function renderPagePlugin($fbPageLink, $tabs = self::PAGE_TIMELINE, $width = 350, $height = 500, $smallHeader = false, $hideCoverPhoto = false, $showFaces = false)
    {
        if ($fbPageLink == '' || $fbPageLink == NULL) {
            throw new \SocialPlugins\Facebook\Exception\InputException('Facebook page URL must be defined.',500);
        }

        if ($width < 180 || $width > 500) {
            throw new \SocialPlugins\Facebook\Exception\InputException('Width must be in this range -> (180-500)px.',500);
        }

        if ($height < 70) {
            throw new \SocialPlugins\Facebook\Exception\InputException('Height must be bigger then 70px.',500);
        }

        $parameters = array(
            "link" => $fbPageLink,
            "tabs" => $tabs,
            "width" => $width,
            "height" => $height,
            "smallHeader" => $smallHeader,
            "hideCover" => $hideCoverPhoto,
            "faces" => $showFaces,
        );

        $this->latte->render(__DIR__ . '/templates/fbPage.latte', $parameters);
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}