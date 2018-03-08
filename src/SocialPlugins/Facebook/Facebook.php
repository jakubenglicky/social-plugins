<?php
/**
 * Part of jakubenglicky/social-plugins
 */

namespace jakubenglicky\SocialPlugins;

use jakubenglicky\SocialPlugins\Facebook\Options\Language;
use jakubenglicky\SocialPlugins\Facebook\Options\Layout;
use jakubenglicky\SocialPlugins\Facebook\Options\Size;
use jakubenglicky\SocialPlugins\Facebook\Options\Tab;
use jakubenglicky\SocialPlugins\Facebook\Exception\InputException;

/*
 * @see Facebook
 * */
class Facebook
{
    /**
     * @var Helpers
     */
    private $helpers;

    /**
     * @var string $locale|'cs_CZ'
     */
    private $locale;

    /**
     * @var integer $commentsWidth|550
     */
    private $commentsWidth = 550;


    public function __construct($globalCommentsWidth = 550)
    {
        $this->helpers = new Helpers();

        $this->setLocale(Language::CZECH);
    }

    /**
     * Get FB root html
     * return string of html
     */
    public function renderInit()
    {
        $parameters = array(
            "locale" => $this->locale,
        );

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/fbRoot.latte', $parameters);
    }

    /**
     * Get HTML of FB comments
     * @param string $link
     * @param integer $limit|5
     * @param integer $width|550
     * @throws InputException
     * return string of html
     */

    public function renderComments($limit = 5, $width = null, $link = null)
    {
        if (!filter_var($link, FILTER_VALIDATE_URL) && $link != null || $link === '') {
            throw new InputException('Link must be in correct format.', 500);
        }

        if ($width == null) {
            $width = $this->commentsWidth;
        }

        if (!is_integer($limit) || !is_integer($width)) {
            throw new InputException('These values (limit, width) must be integer.', 500);
        }

        if ($link == null) {
            $link = $this->helpers->getUrl();
        }

        $parameters = array(
            "link" => $link,
            "limit" => $limit,
            "width" => $width,
        );

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/fbComments.latte', $parameters);
    }

    /**
     * Get HTML of Like Button
     * @param string $link
     * @param boolean $shareButton|FALSE
     * @param string $layout|button_count
     * @param string $size|small
     * @param string $showFaces|FALSE
     * @throws InputException
     * return string of html
     */
    public function renderLikeButton($shareButton = false, $layout = Layout::BUTTON_COUNT, $size = Size::SMALL, $showFaces = false, $link = null)
    {
        if (!filter_var($link, FILTER_VALIDATE_URL) && $link != null || $link === '') {
            throw new InputException('Link must be in corrent format.', 500);
        }

        if (!is_bool($shareButton) || !is_bool($showFaces)) {
            throw new InputException('These values (shareButton, showFaces) must be boolean.', 500);
        }

        if (!in_array($layout, Layout::FOLLOW_LAYOUT_OPTIONS)) {
            throw new InputException('Layout must be select from options.', 500);
        }

        if (!in_array($size, Size::OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if ($link == null) {
            $link = $this->helpers->getUrl();
        }

        $parameters = array(
            "link" => $link,
            "layout" => $layout,
            "size" => $size,
            "share" => $shareButton,
            "faces" => $showFaces,
        );

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/fbLike.latte', $parameters);
    }

    /**
     * Get HTML of Share Button
     * @param string $shareLink
     * @param string $layout|button_count
     * @param string $size|small
     * @param boolean $mobileFrame|FALSE
     * @throws InputException
     * return string of html
     */
    public function renderShareButton($shareLink = null, $layout = Layout::BUTTON_COUNT, $size = Size::SMALL, $mobileFrame = false)
    {
        if (!filter_var($shareLink, FILTER_VALIDATE_URL) && $shareLink != null || $shareLink === '') {
            throw new InputException('Share link must be in correct format.', 500);
        }

        if (!in_array($layout, Layout::SHARE_LAYOUT_OPTIONS)) {
            throw new InputException('Layout must be select from options.', 500);
        }

        if (!in_array($size, Size::OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if (!is_bool($mobileFrame)) {
            throw new InputException('This value (mobileFrame) must be boolean.', 500);
        }

        if ($shareLink == null) {
            $shareLink = $this->helpers->getUrl();
        }

        $parameters = array(
            "link" => $shareLink,
            "layout" => $layout,
            "size" => $size,
            "mobileFrame" => $mobileFrame,
        );

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/fbShare.latte', $parameters);
    }

    /**
     * Get HTML of Follow Button
     * @param string $fbFollowLink
     * @param integer $width|200
     * @param string $size|small
     * @param boolean $layout|button_count
     * @param boolean $showFaces
     * @throws InputException
     * return string of html
     */
    public function renderFollowButton($fbFollowLink, $width = 200, $size = Size::SMALL, $layout = Layout::BUTTON_COUNT, $showFaces = false)
    {
        if (!filter_var($fbFollowLink, FILTER_VALIDATE_URL) || $fbFollowLink === '') {
            throw new InputException('Follow link must be defined in correct format.', 500);
        }

        if (!is_integer($width)) {
            throw new InputException('Width must be integer.', 500);
        }

        if (!in_array($size, Size::OPTIONS)) {
            throw new InputException('Size must be select from options.', 500);
        }

        if (!in_array($layout, Layout::FOLLOW_LAYOUT_OPTIONS)) {
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

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/fbFollow.latte', $parameters);
    }

    /**
     * Get HTML of Page
     * @param string $fbPageLink
     * @param string $tabs
     * @param integer $width|350
     * @param integer $height|500
     * @param boolean $smallHeader|FALSE
     * @param boolean $hideCoverPhoto|FALSE
     * @param boolean $showFaces|FALSE
     * @throws InputException
     * return string of html
     */
    public function renderPagePlugin($fbPageLink, $tabs = Tab::TIMELINE, $width = 350, $height = 500, $smallHeader = false, $hideCoverPhoto = false, $showFaces = false)
    {
        if (!filter_var($fbPageLink, FILTER_VALIDATE_URL) || $fbPageLink === '') {
            throw new InputException('Facebook page URL must be defined in correct format.', 500);
        }

        if ($width < 180 || $width > 500) {
            throw new InputException('Width must be in this range -> (180-500)px.', 500);
        }

        if ($height < 70) {
            throw new InputException('Height must be bigger then 70px.', 500);
        }

        if (!in_array($tabs, Tab::OPTIONS)) {
            throw new InputException('Tab must be select from options.', 500);
        }

        if (!is_bool($smallHeader) || !is_bool($hideCoverPhoto) || !is_bool($showFaces)) {
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

        return $this->helpers->latte->renderToString(__DIR__ . '/templates/fbPage.latte', $parameters);
    }

    /**
     * Setter of locale property
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * Setter of commentWidth property
     * @throws InputException
     * @param integer $width
     */
    public function setCommentsWidth($width)
    {
        if (!is_integer($width)) {
            throw new InputException('Width must be integer.', 500);
        }

        $this->commentsWidth = $width;
    }
}
