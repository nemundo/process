<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Notification\Com\Container\UserNotificationContainer;
use Nemundo\Web\Site\AbstractSite;

class UserNotificationSite extends AbstractSite
{

    /**
     * @var UserNotificationSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title[LanguageCode::EN] = 'Notification';
        $this->title[LanguageCode::DE] = 'Benachrichtigungen';
        $this->url = 'notification';

        UserNotificationSite::$site = $this;

        new NotificationItemSite($this);
        new ArchiveSite($this);
        new RedirectSite($this);
        new UserNotificationDeleteSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $nav = new AdminNavigation($page);
        $nav->site = UserNotificationSite::$site;

        new UserNotificationContainer($page);

        $page->render();

    }

}