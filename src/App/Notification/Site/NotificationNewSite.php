<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Web\Site\AbstractSite;

class NotificationNewSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->title = 'New';
        $this->url = 'new';
        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();




        $page->render();


    }

}