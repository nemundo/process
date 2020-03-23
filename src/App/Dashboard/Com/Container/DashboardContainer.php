<?php


namespace Nemundo\Process\App\Dashboard\Com\Container;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\App\Dashboard\Data\UserDashboard\UserDashboardReader;
use Nemundo\Process\App\Dashboard\Site\DashboardEditSite;
use Nemundo\User\Type\UserSessionType;

class DashboardContainer extends AbstractHtmlContainer
{

    public function getContent()
    {

        $btn = new AdminIconSiteButton($this);
        $btn->site = DashboardEditSite::$site;


        $reader = new UserDashboardReader();
        $reader->model->loadDashboard();
        $reader->model->dashboard->loadContentType();
        $reader->filter->andEqual($reader->model->userId, (new UserSessionType())->userId);
        foreach ($reader->getData() as $userDashboardRow) {

            $contentType = $userDashboardRow->dashboard->getContentType();

            $widget = new AdminWidget($this);
            $widget->widgetTitle = $contentType->getSubject();
            $widget->widgetSite = $contentType->getViewSite();
            $contentType->getView($widget);

        }

        return parent::getContent();

    }

}