<?php

namespace Nemundo\Process\App\Dashboard\Site;

use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Dashboard\Com\Container\DashboardContainer;
use Nemundo\Web\Site\AbstractSite;

class DashboardSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Dashboard';
        $this->url = 'dashboard';

        new DashboardEditSite($this);
        new DashboardDeleteSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        new DashboardContainer($page);

        $page->render();

    }
}