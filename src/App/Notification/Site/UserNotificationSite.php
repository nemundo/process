<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Notification\Com\Table\UserNotificationTable;
use Nemundo\Process\App\Notification\Data\Notification\NotificationPaginationReader;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Filter\UserNotificationFilter;
use Nemundo\Process\App\Notification\Parameter\ArchiveParameter;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
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

        $this->title[LanguageCode::EN] = 'Notification';
        $this->title[LanguageCode::DE] = 'Benachrichtigungen';
        $this->url = 'notification';

        UserNotificationSite::$site = $this;

        new NotificationNewSite($this);
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


        //$type = new MessageNotificationContentType();
        //$type->getForm($page);


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new BootstrapListBox($formRow);
        $listbox->name=(new ArchiveParameter())->getParameterName();
        $listbox->emptyValueAsDefault = false;
        $listbox->addItem('0', 'Offene');
        $listbox->addItem('1', 'Gelöschte/Archivierte');
        //$listbox->addItem(2,'Gesendete');
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;


        $layout = new BootstrapThreeColumnLayout($page);
        $layout->col1->columnWidth= 2;
        $layout->col2->columnWidth= 5;
        $layout->col3->columnWidth= 5;

        $list=new BootstrapHyperlinkList($layout->col1);


        $reader =new NotificationReader();
        $reader->model->loadContentType();
        $reader->filter=new UserNotificationFilter(false);
        $reader->addGroup($reader->model->contentTypeId);

        $countField = new CountField($reader);

        foreach ($reader->getData() as $notificationRow) {

            $count =$notificationRow->getModelValue($countField);

            $site = clone(UserNotificationSite::$site);
            $site->addParameter(new ArchiveParameter());
            $site->addParameter(new ContentTypeParameter($notificationRow->contentTypeId));
            $site->title=$notificationRow->contentType->contentType.' ('.$count.')';
            $list->addSite($site);

        }




        $btn = new AdminSiteButton($layout->col2);
        $btn->site = UserNotificationDeleteSite::$site;


        new UserNotificationTable($layout->col2);



        /*
        $table = new AdminClickableTable($layout->col2);

        $header = new TableHeader($table);
        //$header->addText('Archive');
        $header->addText('Notification Type');
        $header->addText('Subject');
        $header->addText('Message');
        $header->addText('Date/Time');
        //$header->addText('To');
$header->addEmpty();


        $notificationReader = new NotificationPaginationReader();
        //$notificationReader->model->loadSubjectContent();
        //$notificationReader->model->subjectContent->loadContentType();
        $notificationReader->model->loadContent();
        $notificationReader->model->content->loadContentType();
        //$notificationReader->model->loadTo();

        $notificationReader->filter = new UserNotificationFilter();

        //$notificationReader->filter->andEqual($notificationReader->model->toId, (new UserSessionType())->userId);

        /*
        if ($listbox->hasValue()) {

        if ($listbox->getValue() =='0') {
               $notificationReader->filter->andEqual($notificationReader->model->archive,false);
        } else {
            $notificationReader->filter->andEqual($notificationReader->model->archive,true);
        }

        } else {

        }*/


        /*
        $notificationReader->addOrder($notificationReader->model->id, SortOrder::DESCENDING);
        $notificationReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;
        foreach ($notificationReader->getData() as $notificationRow) {

            $row = new BootstrapClickableTableRow($table);
            //$row->addYesNo($notificationRow->archive);
            $row->addText($notificationRow->content->contentType->contentType);

            if ($notificationRow->read) {
                $row->addText($notificationRow->subject);
                $row->addText($notificationRow->message);
                $row->addText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            } else {
                $row->addBoldText($notificationRow->subject);
                $row->addBoldText($notificationRow->message);
                $row->addBoldText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            }


            //$contentType = $notificationRow->content->getContentType();
            //  $row->addText($contentType->getSubject());
            //  $row->addText($contentType->getMessage());*/


            //  $row->addText($notificationRow->to->displayName);

         /*   $site = clone(ArchiveSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $row->addIconSite($site);

            $site = clone(RedirectSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $row->addClickableSite($site);

            //$row->addClickableSite($contentType->getViewSite());

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $notificationReader;*/

        $page->render();

    }


}