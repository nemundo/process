<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Notification\Content\File\FileNotificationContentType;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
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

        $nav = new AdminNavigation($page);
        $nav->site = UserNotificationSite::$site;

        $type = new MessageNotificationContentType();

      //  $type=new FileNotificationContentType();
        $form = $type->getForm($page);
        $form->redirectSite = UserNotificationSite::$site;


        $page->render();


    }

}