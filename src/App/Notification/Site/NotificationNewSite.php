<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
use Nemundo\Web\Site\AbstractSite;

class NotificationNewSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->title[LanguageCode::EN] = 'New';
        $this->title[LanguageCode::DE] = 'Neu';
        $this->url = 'new';

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