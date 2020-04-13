<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Favorite\Com\FavoriteButton;
use Nemundo\Process\App\Notification\Com\HyperlinkList\NotificationContentTypeHyperlinkList;
use Nemundo\Process\App\Notification\Com\Table\UserNotificationTable;
use Nemundo\Process\App\Notification\Content\Forward\ForwardContentForm;
use Nemundo\Process\App\Notification\Data\Notification\NotificationPaginationReader;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Filter\UserNotificationFilter;
use Nemundo\Process\App\Notification\Parameter\ArchiveParameter;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Process\App\Notification\Parameter\SourceParameter;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\Site\AbstractSite;

class UserNotificationInboxSite extends AbstractSite
{

    /**
     * @var UserNotificationSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title[LanguageCode::EN] = 'Notification Inbox';
        $this->title[LanguageCode::DE] = 'Benachrichtigungen Inbox';
        $this->url = 'notification-inbox';

        UserNotificationInboxSite::$site= $this;



    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $nav = new AdminNavigation($page);
        $nav->site = UserNotificationInboxSite::$site;  // UserNotificationSite::$site;

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

        $list=new NotificationContentTypeHyperlinkList($layout->col1);
        $list->redirectSite=UserNotificationInboxSite::$site;




        $subtitle=new AdminSubtitle($layout->col1);
        $subtitle->content='Source';

        $sourceList=new BootstrapHyperlinkList($layout->col1);

        $notificationReader = new NotificationReader();
        $notificationReader->model->loadSource();
        $notificationReader->filter = new UserNotificationFilter();
        $notificationReader->addGroup($notificationReader->model->sourceId);

        $count = new CountField($notificationReader);

        foreach ($notificationReader->getData() as $notificationCustomRow) {

            $site = clone(UserNotificationInboxSite::$site);
            $site->title = $notificationCustomRow->source->subject.' ('.$notificationCustomRow->getModelValue($count).')';
            $site->addParameter(new SourceParameter($notificationCustomRow->sourceId));
            $sourceList->addSite($site);


        }





        /*
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

        }*/

        $btn = new AdminSiteButton($layout->col2);
        $btn->site = UserNotificationDeleteSite::$site;



        $table = new AdminClickableTable($layout->col2);

        $header = new TableHeader($table);

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Category';
        $th->content[LanguageCode::DE] = 'Kategorie';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Source';
        $th->content[LanguageCode::DE] = 'Quelle';


        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Subject';
        $th->content[LanguageCode::DE] = 'Betreff';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Message';
        $th->content[LanguageCode::DE] = 'Nachricht';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Date';
        $th->content[LanguageCode::DE] = 'Datum';

        $header->addEmpty();


        $notificationReader = new NotificationPaginationReader();
        $notificationReader->model->loadCategory();
        $notificationReader->model->loadContent();
        $notificationReader->model->content->loadContentType();
        $notificationReader->model->loadSource();
        $notificationReader->filter = new UserNotificationFilter();
        $notificationReader->addOrder($notificationReader->model->id, SortOrder::DESCENDING);
        $notificationReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;
        foreach ($notificationReader->getData() as $notificationRow) {

            $row = new BootstrapClickableTableRow($table);

            $row->addText($notificationRow->category->category);
            $row->addText($notificationRow->source->subject);


            if ($notificationRow->read) {
                $row->addText($notificationRow->subject);
                $row->addText($notificationRow->message);
                $row->addText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            } else {
                $row->addBoldText($notificationRow->subject);
                $row->addBoldText($notificationRow->message);
                $row->addBoldText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            }

            $site = clone(ArchiveSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $row->addIconSite($site);

            $site = clone(UserNotificationInboxSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $site->addParameter(new SourceParameter());
            $row->addClickableSite($site);

        }

        $pagination = new BootstrapPagination($layout->col2);
        $pagination->paginationReader = $notificationReader;



        $notificationParameter=new NotificationParameter();
        if ($notificationParameter->hasValue()) {


           $contentType =  $notificationParameter->getContentType();


           $title=new AdminTitle($layout->col3);
           $title->content=$contentType->getSubject();

           $btn=new AdminSiteButton($layout->col3);
           $btn->site=$contentType->getSubjectViewSite();

           if ($contentType->hasView()) {
               $contentType->getView($layout->col3);
           }




 /*
            $btn = new AdminSiteButton($layout->col3);
            $btn->site = $contentType->getSubjectViewSite();

            $btn=new FavoriteButton($layout->col3);
            $btn->contentType = $contentType;



            $form = new ForwardContentForm($layout->col3);
            $form->contentType= $contentType;*/

            // share
            // favorite
            // open



        }




        $page->render();

    }


}