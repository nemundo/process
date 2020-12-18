<?php

namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\User\Session\UserSession;
use Nemundo\Core\Http\Url\UrlReferer;


class UserNotificationDeleteSite extends AbstractDeleteIconSite
{

    /**
     * @var ArchiveSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Alle Benachrichtigungen löschen';
        $this->url = 'delete-user-notification';

        UserNotificationDeleteSite::$site = $this;

    }


    public function loadContent()
    {

        $update = new NotificationUpdate();
        $update->filter->andEqual($update->model->toId, (new UserSession())->userId);
        $update->archive = true;
        $update->update();

        (new UrlReferer())->redirect();

    }

}