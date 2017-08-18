<?php

namespace SocialPlugins;

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

    /* Sizes */
    const SIZE_SMALL = 'small';
    const SIZE_LARGE = 'large';


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
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}