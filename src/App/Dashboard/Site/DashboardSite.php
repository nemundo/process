<?php

namespace Nemundo\Process\App\Dashboard\Site;

use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Dashboard\Data\Dashboard\DashboardReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Web\Site\AbstractSite;

class DashboardSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Dashboard';
        $this->url = 'dashboard';
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $form = new SearchForm($page);

        $listbox = new BootstrapListBox($form);
        $listbox->name = (new ContentParameter())->getParameterName();
        $listbox->searchMode = true;
        $listbox->submitOnChange = true;

        $reader = new DashboardReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        foreach ($reader->getData() as $dashboardRow) {

            $listbox->addItem($dashboardRow->contentId, $dashboardRow->content->subject);
            /*
           $contentType =  $dashboardRow->content->getContentType();

           $widget = new AdminWidget($page);
           $widget->widgetTitle=$contentType->getSubject();

           $contentType->getView($widget);*/

        }


        $contentParameter = new ContentParameter();
        if ($contentParameter->exists()) {

            $contentType = $contentParameter->getContentType();

            $widget = new AdminWidget($page);
            $widget->widgetTitle = $contentType->getSubject();

            $contentType->getView($widget);

        }


        $page->render();

    }
}