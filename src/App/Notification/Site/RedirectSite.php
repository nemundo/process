<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Data\Notification\NotificationUpdate;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Web\Site\AbstractSite;

class RedirectSite extends AbstractSite
{

    /**
     * @var RedirectSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->url='redirect';
        $this->menuActive=false;
        // TODO: Implement loadSite() method.

        RedirectSite::$site=$this;

    }


    public function loadContent()
    {

        $notificationId=(new NotificationParameter())->getValue();

        $update = new NotificationUpdate();
        $update->read=true;
        $update->updateById($notificationId);

        $reader=new NotificationReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $notificationRow = $reader->getRowById($notificationId);
        $contentType = $notificationRow->getContentType();
        $contentType->getViewSite()->redirect();

        // TODO: Implement loadContent() method.
    }

}