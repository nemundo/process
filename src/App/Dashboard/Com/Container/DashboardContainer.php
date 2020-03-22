<?php


namespace Nemundo\Process\App\Dashboard\Com\Container;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\App\Dashboard\Data\UserDashboard\UserDashboardReader;
use Nemundo\Process\App\Dashboard\Parameter\DashboardParameter;
use Nemundo\Process\App\Dashboard\Site\DashboardDeleteSite;
use Nemundo\Process\App\Dashboard\Site\DashboardEditSite;
use Nemundo\User\Type\UserSessionType;

class DashboardContainer extends AbstractHtmlContainer
{

    public function getContent()
    {

        $btn=new AdminIconSiteButton($this);
        $btn->site=DashboardEditSite::$site;


        $reader = new UserDashboardReader();
        $reader->model->loadDashboard();
        $reader->model->dashboard->loadContentType();
        $reader->filter->andEqual($reader->model->userId, (new UserSessionType())->userId);
        foreach ($reader->getData() as $userDashboardRow) {


            $contentType = $userDashboardRow->dashboard->getContentType();

            $widget = new AdminWidget($this);
            $widget->widgetTitle = $contentType->getSubject();
            $contentType->getView($widget);

            /*
            $btn = new AdminIconSiteButton($widget);
            $btn->site= clone(DashboardDeleteSite::$site);
            $btn->site->addParameter(new DashboardParameter($userDashboardRow->id));*/

        }

        return parent::getContent();

    }

}