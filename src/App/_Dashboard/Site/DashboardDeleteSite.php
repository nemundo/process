<?php


namespace Nemundo\Process\App\Dashboard\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\App\Dashboard\Data\UserDashboard\UserDashboardDelete;
use Nemundo\Process\App\Dashboard\Parameter\DashboardParameter;
use Nemundo\Core\Http\Url\UrlReferer;

class DashboardDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var DashboardDeleteSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Delete';
        $this->url = 'delete';
        $this->menuActive = false;

        DashboardDeleteSite::$site = $this;

    }


    public function loadContent()
    {


        $dashboardId = (new DashboardParameter())->getValue();
        (new UserDashboardDelete())->deleteById($dashboardId);

        (new UrlReferer())->redirect();


    }

}