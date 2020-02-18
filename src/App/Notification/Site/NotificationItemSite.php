<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Web\Site\AbstractSite;

class NotificationItemSite extends AbstractSite
{
    /**
     * @var NotificationItemSite
     */
    public static $site;

    protected function loadSite()
    {
        // TODO: Implement loadSite() method.

        $this->url = 'notification-item';
        $this->menuActive=false;

        NotificationItemSite::$site=$this;

    }


    public function loadContent()
    {
        // TODO: Implement loadContent() method.

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();


        $notificationId=(new NotificationParameter())->getValue();

        $notificationReader = new NotificationReader();
        $notificationReader->model->loadContent();
        $notificationReader->model->content->loadContentType();
        $notificationReader->model->loadSubjectContent();
        $notificationReader->model->subjectContent->loadContentType();


        $notificationRow = $notificationReader->getRowById($notificationId);

        /** @var AbstractNotificationContentType $notificationType */
        $notificationType = $notificationRow->content->getContentType();


        $subjectType = $notificationRow->subjectContent->getContentType();

        $table = new AdminLabelValueTable($page);
        $table->addLabelValue('Subject',       $subjectType->getSubject());
        $table->addLabelValue('Message',       $notificationType->getMessage());

        $page->render();


    }

}