<?php

namespace FacebookSocialPlugins;

use Latte\Engine;

class Control
{
    private $latte;

    public function __construct()
    {
        $this->latte = new Engine();
    }

    public function renderRoot($appId)
    {
        $parameters = array(
            "appId" => $appId,
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
}