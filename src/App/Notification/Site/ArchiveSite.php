<?php

namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Package\FontAwesome\Site\AbstractDeleteIconSite;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\Web\Url\UrlReferer;
use Nemundo\Workflow\App\Notification\Parameter\NotificationParameter;


class ArchiveSite extends AbstractDeleteIconSite
{

    /**
     * @var ArchiveSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->url = 'notification-archive';

        ArchiveSite::$site = $this;

    }


    public function loadContent()
    {

        $notificationId = (new NotificationParameter())->getValue();

        $update = new NotificationUpdate();
        $update->archive = true;
        $update->updateById($notificationId);

        (new UrlReferer())->redirect();

    }

}