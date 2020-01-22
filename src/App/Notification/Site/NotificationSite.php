<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Assignment\Com\ListBox\AssignmentStatusListBox;
use Nemundo\Process\App\Notification\Content\File\FileNotificationContentType;
use Nemundo\Process\App\Notification\Data\Notification\NotificationPaginationReader;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class NotificationSite extends AbstractSite
{

    /**
     * @var NotificationSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Notification';
        $this->url = 'notification';

        NotificationSite::$site=$this;

        new ArchiveSite($this);

        // TODO: Implement loadSite() method.
    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        //$form = (new FileNotificationContentType())->getForm($page);
        //$form->redirectSite=new Site();


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $user = new UserListBox($formRow);
        $user->submitOnChange=true;
        $user->searchMode=true;


        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Archive');
        $header->addText('Type');
        $header->addText('Subject');
        $header->addText('Message');
        $header->addText('Date/Time');
        $header->addText('To');

        $reader = new NotificationPaginationReader();
        $reader->model->loadSubjectContent();
        $reader->model->subjectContent->loadContentType();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->model->loadTo();
        $reader->addOrder($reader->model->id, SortOrder::DESCENDING);
        $reader->paginationLimit = 50;
        foreach ($reader->getData() as $notificationRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addYesNo($notificationRow->archive);
            $row->addText($notificationRow->content->contentType->contentType);
            $row->addText($notificationRow->subjectContent->subject);
            $row->addText($notificationRow->message);

            $row->addText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($notificationRow->to->displayName);

            $row->addClickableSite($notificationRow->subjectContent->getContentType()->getViewSite());

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $reader;





        $page->render();

        // TODO: Implement loadContent() method.
    }


}