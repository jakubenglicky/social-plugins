<?php

namespace FacebookSocialPlugins;

use Nette;

class FacebookSocialPluginsControl extends Nette\Application\UI\Control
{
    public function renderRoot($appId)
    {
        $this->template->appId = $appId;
        $this->template->render(__DIR__ . '/templates/fbRoot.latte');
    }

    public function renderComments($link, $limit = 5, $width = 550)
    {
        $this->template->link = $link;
        $this->template->limit = $limit;
        $this->template->width = $width;

        $this->template->render(__DIR__ . '/templates/fbComments.latte');
    }
}