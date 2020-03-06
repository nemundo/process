<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Notification\Data\Notification\NotificationPaginationReader;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\Site\AbstractSite;

class UserNotificationSite extends AbstractSite
{

    /**
     * @var UserNotificationSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Notification';
        $this->url = 'notification';

        UserNotificationSite::$site = $this;

        new NotificationItemSite($this);
        new ArchiveSite($this);
        new UserNotificationDeleteSite($this);


        // TODO: Implement loadSite() method.
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form=new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new BootstrapListBox($formRow);
        $listbox->addItem(0,'Offene');
        $listbox->addItem(0,'Gelöschte/Archivierte');


        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Archive');
        $header->addText('Notification Type');
        $header->addText('Subject');
        $header->addText('Message');
        $header->addText('Date/Time');
        $header->addText('To');

        $notificationReader = new NotificationPaginationReader();
        $notificationReader->model->loadSubjectContent();
        $notificationReader->model->subjectContent->loadContentType();
        $notificationReader->model->loadContent();
        $notificationReader->model->content->loadContentType();
        $notificationReader->model->loadTo();

        $notificationReader->filter->andEqual($notificationReader->model->toId, (new UserSessionType())->userId);

        $notificationReader->addOrder($notificationReader->model->id, SortOrder::DESCENDING);
        $notificationReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;
        foreach ($notificationReader->getData() as $notificationRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addYesNo($notificationRow->archive);
            $row->addText($notificationRow->content->contentType->contentType);
            $row->addText($notificationRow->subjectContent->subject);
            $row->addText($notificationRow->message);

            $row->addText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($notificationRow->to->displayName);

            $site = clone(ArchiveSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $row->addIconSite($site);


            $row->addClickableSite($notificationRow->subjectContent->getContentType()->getViewSite());

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $notificationReader;

        $page->render();

    }


}