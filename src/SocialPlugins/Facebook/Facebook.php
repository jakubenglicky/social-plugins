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

    public function renderLike($link, $shareButton = false, $layout = 'button_count', $size = 'small', $faces = false)
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
     * @param string $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}