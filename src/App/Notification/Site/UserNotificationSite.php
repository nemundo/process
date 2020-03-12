<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Notification\Content\AbstractNotificationContentType;
use Nemundo\Process\App\Notification\Content\Message\MessageNotificationContentType;
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

        new NotificationNewSite($this);
        new NotificationItemSite($this);
        new ArchiveSite($this);
        new UserNotificationDeleteSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $nav = new AdminNavigation($page);
        $nav->site=UserNotificationSite::$site;


        //$type = new MessageNotificationContentType();
        //$type->getForm($page);




        $form=new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new BootstrapListBox($formRow);
$listbox->emptyValueAsDefault=false;
        $listbox->addItem(0,'Offene');
        $listbox->addItem(1,'Gelöschte/Archivierte');
        //$listbox->addItem(2,'Gesendete');
        $listbox->submitOnChange=true;
        $listbox->searchMode=true;


        $btn=new AdminSiteButton($page);
        $btn->site = UserNotificationDeleteSite::$site;




        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Archive');
        $header->addText('Notification Type');
        $header->addText('Subject');
        $header->addText('Message');
        $header->addText('Date/Time');
        $header->addText('To');

        $notificationReader = new NotificationPaginationReader();
        //$notificationReader->model->loadSubjectContent();
        //$notificationReader->model->subjectContent->loadContentType();
        $notificationReader->model->loadContent();
        $notificationReader->model->content->loadContentType();
        //$notificationReader->model->loadTo();

        $notificationReader->filter->andEqual($notificationReader->model->toId, (new UserSessionType())->userId);

        /*
        if ($listbox->hasValue()) {

        if ($listbox->getValue() =='0') {
               $notificationReader->filter->andEqual($notificationReader->model->archive,false);
        } else {
            $notificationReader->filter->andEqual($notificationReader->model->archive,true);
        }

        } else {

        }*/


        $notificationReader->addOrder($notificationReader->model->id, SortOrder::DESCENDING);
        $notificationReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;
        foreach ($notificationReader->getData() as $notificationRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addYesNo($notificationRow->archive);
            $row->addText($notificationRow->content->contentType->contentType);
            $row->addText($notificationRow->subject);
            $row->addText($notificationRow->message);


            $contentType = $notificationRow->content->getContentType();
          //  $row->addText($contentType->getSubject());
          //  $row->addText($contentType->getMessage());*/


            $row->addText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
          //  $row->addText($notificationRow->to->displayName);

            $site = clone(ArchiveSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $row->addIconSite($site);

            $row->addClickableSite($contentType->getViewSite());

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $notificationReader;

        $page->render();

    }


}