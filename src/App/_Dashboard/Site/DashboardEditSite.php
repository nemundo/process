<?php


namespace Nemundo\Process\App\Dashboard\Site;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\FontAwesome\Site\AbstractEditIconSite;
use Nemundo\Process\App\Dashboard\Com\Form\DashboardForm;
use Nemundo\Process\App\Dashboard\Data\UserDashboard\UserDashboardReader;
use Nemundo\Process\App\Dashboard\Parameter\DashboardParameter;
use Nemundo\User\Session\UserSession;

class DashboardEditSite extends AbstractEditIconSite
{

    /**
     * @var DashboardEditSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Dashboard Edit';
        $this->url = 'dashboard-edit';
        $this->menuActive = false;

        DashboardEditSite::$site = $this;

    }


    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new DashboardForm($page);
        $form->redirectSite = DashboardEditSite::$site;

        $reader = new UserDashboardReader();
        $reader->model->loadDashboard();
        //$reader->model->dashboard->loadContent();
        $reader->model->dashboard->loadContentType();
        $reader->filter->andEqual($reader->model->userId, (new UserSession())->userId);
        foreach ($reader->getData() as $userDashboardRow) {

            $contentType = $userDashboardRow->dashboard->getContentType();

            $widget = new AdminWidget($page);
            $widget->widgetTitle = $contentType->getSubject();
            $contentType->getView($widget);


            $btn = new AdminIconSiteButton($widget);
            $btn->site = clone(DashboardDeleteSite::$site);
            $btn->site->addParameter(new DashboardParameter($userDashboardRow->id));


        }


        /*
        $form = new SearchForm($page);


        $listbox = new ContentTypeCollectionListBox($form);
        $listbox->contentTypeCollection = new DashboardContentTypeCollection();
        $listbox->searchMode = true;
        $listbox->submitOnChange = true;


        /*
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

        //}


        /*

        $contentTypeParameter = new ContentTypeParameter();
        $contentTypeParameter->addAllowedContentTypeCollection( new DashboardContentTypeCollection());

        if ($contentTypeParameter->exists()) {



            $contentType = $contentTypeParameter->getContentType();



            $widget = new AdminWidget($page);
            $widget->widgetTitle = $contentType->getSubject();

            $contentType->getView($widget);


        }




        $contentParameter = new ContentParameter();
        if ($contentParameter->exists()) {

            $contentType = $contentParameter->getContentType();

            $widget = new AdminWidget($page);
            $widget->widgetTitle = $contentType->getSubject();

            $contentType->getView($widget);

        }*/


        $page->render();


    }

}