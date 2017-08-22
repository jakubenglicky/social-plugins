<?php

namespace SocialPlugins;

use SocialPlugins\Facebook\Exception\InputException;

/*
 * @see Facebook
 * */
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

    const LIKE_FOLLOW_LAYOUT_OPTIONS = [self::LAYOUT_BUTTON_COUNT, self::LAYOUT_BUTTON, self::LAYOUT_BOX_COUNT, self::LAYOUT_STANDARD];
    const SHARE_LAYOUT_OPTIONS = [self::LAYOUT_BUTTON_COUNT, self::LAYOUT_BUTTON, self::LAYOUT_BOX_COUNT];


    /* Sizes */
    const SIZE_SMALL = 'small';
    const SIZE_LARGE = 'large';

    const SIZE_OPTIONS = [self::SIZE_SMALL, self::SIZE_LARGE];

    /* Page Tabs */
    const PAGE_TIMELINE = 'timeline';
    const PAGE_EVENTS = 'events';
    const PAGE_MESSAGES = 'messages';

    const TABS_OPTIONS = [self::PAGE_TIMELINE, self::PAGE_EVENTS, self::PAGE_MESSAGES];

    public function __construct()
    {
        $this->latte = new \Latte\Engine();

        $this->setLocale('cs_CZ');
    }

    /**
     * return string of html
     */
    public function renderInit()
    {
        $parameters = array(
            "locale" => $this->locale,
        );

        return $this->latte->renderToString(__DIR__ . '/templates/fbRoot.latte', $parameters);
    }

    /**
     * @param string $link
     * @param integer $limit|5
     * @param integer $width|550
     * return string of html
     */

    public function renderComments($link = NULL, $limit = 5, $width = 550)
    {
        if ($link === '' || $link === 'NULL') {
            throw new InputException('Link must be defined.', 500);
        }

        if (!is_integer($limit) || !is_integer($width)) {
            throw new InputException('These values (limit, width) must be integer.', 500);
        }

        if ($link == NULL) {
            $link = $this->getUrl();
        }

        $parameters = array(
            "link" => $link,
            "limit" => $limit,
            "width" => $width,
        );

        return $this->latte->renderToString(__DIR__ . '/templates/fbComments.latte', $parameters);

    }

    /**
     * @param string $link
     * @param boolean $shareButton|FALSE
     * @param string $layout|button_count
     * @param string $size|small
     * @param string $faces|FALSE
     * return string of html
     */
    public function renderLikeButton($link = NULL, $shareButton = FALSE, $layout = self::LAYOUT_BUTTON_COUNT, $size = self::SIZE_SMALL, $showFaces = FALSE)
    {
        if ($link === '' || $link === 'NULL') {
            throw new InputException('Link must be defined.', 500);
        }

        if (!is_bool($shareButton) || !is_bool($showFaces)) {
            throw new InputException('These values (shareButton, showFaces) must be boolean.', 500);
        }

        if (!in_array($layout,self::LIKE_FOLLOW_LAYOUT_OPTIONS)) {
            throw new InputException('Layout must be select from options.', 500);
        }

        if (!in_array($size,self::SIZE_OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if ($link == NULL) {
            $link = $this->getUrl();
        }

        $parameters = array(
            "link" => $link,
            "layout" => $layout,
            "size" => $size,
            "share" => $shareButton,
            "faces" => $showFaces,
        );

        return $this->latte->renderToString(__DIR__ . '/templates/fbLike.latte', $parameters);
    }

    /**
     * @param string $link
     * @param string $layout|button_count
     * @param string $size|small
     * @param boolean $mobileFrame|FALSE
     * return string of html
     */
    public function renderShareButton($shareLink = NULL,$layout = self::LAYOUT_BUTTON_COUNT, $size = self::SIZE_SMALL,$mobileFrame = FALSE)
    {
        if ($shareLink === '' || $shareLink === 'NULL') {
            throw new InputException('Share link must be defined in correct format.', 500);
        }

        if (!in_array($layout,self::SHARE_LAYOUT_OPTIONS)) {
            throw new InputException('Layout must be select from options.', 500);
        }

        if (!in_array($size,self::SIZE_OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if (!is_bool($mobileFrame)) {
            throw new InputException('This value (mobileFrame) must be boolean.', 500);
        }

        if ($shareLink == NULL) {
            $shareLink = $this->getUrl();
        }

        $parameters = array(
            "link" => $shareLink,
            "layout" => $layout,
            "size" => $size,
            "mobileFrame" => $mobileFrame,
        );

        return $this->latte->renderToString(__DIR__ . '/templates/fbShare.latte', $parameters);
    }

    /**
     * @param string $link
     * @param integer $width|200
     * @param string $size|small
     * @param boolean $layout|button_count
     * @param boolean $faces
     * return string of html
     */
    public function renderFollowButton($fbFollowLink, $width = 200, $size = self::SIZE_SMALL,$layout = self::LAYOUT_BUTTON_COUNT, $showFaces = FALSE)
    {
        if ($fbFollowLink === '' || $fbFollowLink == NULL || $fbFollowLink === 'NULL') {
            throw new InputException('Follow link must be defined in correct format.', 500);
        }

        if (!is_integer($width)) {
            throw new InputException('Width must be integer.', 500);
        }

        if (!in_array($size,self::SIZE_OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if (!in_array($layout,self::LIKE_FOLLOW_LAYOUT_OPTIONS)) {
            throw new InputException('Layout must be select from options.', 500);
        }

        if (!is_bool($showFaces)) {
            throw new InputException('This value (showFaces) must be boolean.', 500);
        }

        $parameters = array(
            "link" => $fbFollowLink,
            "layout" => $layout,
            "size" => $size,
            "faces" => $showFaces,
            "width" => $width,
        );

        return $this->latte->renderToString(__DIR__ . '/templates/fbFollow.latte', $parameters);
    }

    /**
     * @param string $fbPageLink
     * @param string $tabs
     * @param integer $width|350
     * @param integer $height|500
     * @param boolean $smallHeader|FALSE
     * @param boolean $hideCoverPhoto|FALSE
     * @param boolean $showFaces|FALSE
     * return string of html
     */
    public function renderPagePlugin($fbPageLink, $tabs = self::PAGE_TIMELINE, $width = 350, $height = 500, $smallHeader = FALSE, $hideCoverPhoto = FALSE, $showFaces = FALSE)
    {
        if ($fbPageLink === '' || $fbPageLink == NULL || $fbPageLink === 'NULL') {
            throw new InputException('Facebook page URL must be defined.',500);
        }

        if ($width < 180 || $width > 500) {
            throw new InputException('Width must be in this range -> (180-500)px.',500);
        }

        if ($height < 70) {
            throw new InputException('Height must be bigger then 70px.',500);
        }

        if(!in_array($tabs,self::TABS_OPTIONS)) {
            throw new InputException('Tab must be select from options.', 500);
        }

        if(!is_bool($smallHeader) || !is_bool($hideCoverPhoto) || !is_bool($showFaces)) {
            throw new InputException('These values (smallHeader,hideCoverPhoto,showFaces) must be boolean.', 500);
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

        return $this->latte->renderToString(__DIR__ . '/templates/fbPage.latte', $parameters);
    }

    /**
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    protected function getUrl()
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        return $actual_link;
    }
}