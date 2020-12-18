<?php

namespace Nemundo\Process\App\Dashboard\Site;

use Nemundo\Process\App\Dashboard\Page\DashboardPage;
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

        (new DashboardPage())->render();

    }
}