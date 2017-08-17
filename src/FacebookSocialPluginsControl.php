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
}