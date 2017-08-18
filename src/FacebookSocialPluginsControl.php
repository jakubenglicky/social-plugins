<?php

namespace FacebookSocialPlugins;

use Latte\Engine;

class Control
{
    private $latte;

    private $appId;

    private $locale = 'cs_CZ';

    public function __construct($appId)
    {
        $this->latte = new Engine();
        $this->appId = $appId;
    }

    public function renderInit()
    {
        $parameters = array(
            "appId" => $this->appId,
            "locale" => $this->locale,
        );

       $this->latte->render(__DIR__ . '/templates/fbRoot.latte', $parameters);
    }

    public function renderComments($link, $limit = 5, $width = 550)
    {
        $parameters = array(
            "link" => $link,
            "limit" => $limit,
            "width" => $width,
        );

        $this->latte->render(__DIR__ . '/templates/fbComments.latte', $parameters);

    }

    public function setLocale($locale)
    {
        $this->locale = $locale;
    }
}