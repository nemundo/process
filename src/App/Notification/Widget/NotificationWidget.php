<?php

namespace Nemundo\Process\App\Notification\Widget;


use Nemundo\Admin\Com\Button\AdminIconSiteButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Widget\AdminWidget;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Type\Text\Html;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Process\App\Notification\Site\ArchiveSite;
use Nemundo\Process\App\Notification\Site\NotificationAdminSite;
use Nemundo\Process\App\Notification\Site\UserNotificationDeleteSite;
use Nemundo\Process\App\Notification\Site\UserNotificationSite;
use Nemundo\User\Type\UserSessionType;

class NotificationWidget extends AdminWidget
{


    protected function loadWidget()
    {

        $this->widgetTitle[LanguageCode::EN] = 'Notification';
        $this->widgetTitle[LanguageCode::DE] = 'Benachrichtigungen';

        $this->widgetSite = UserNotificationSite::$site;

    }

    public function getContent()
    {


        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);

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

        $reader = new NotificationReader();
        $reader->model->loadSubjectContent();
        $reader->model->subjectContent->loadContentType();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->model->loadTo();
        $reader->filter->andEqual($reader->model->toId, (new UserSessionType())->userId);
        $reader->filter->andEqual($reader->model->archive, false);
        $reader->addOrder($reader->model->id, SortOrder::DESCENDING);
        $reader->limit = 20;
        foreach ($reader->getData() as $notificationRow) {



            $notificationContentType = $notificationRow->getNotificationContentType();


            $row = new BootstrapClickableTableRow($table);
            //$row->addYesNo($notificationRow->archive);
            //$row->addText($notificationRow->content->contentType->contentType);
            $row->addText($notificationRow->subjectContent->subject);
//            $row->addText($notificationRow->message);
            $row->addText((new Html( $notificationContentType->getMessage()))->getValue());


            $row->addText($notificationRow->content->dateTime->getShortDateTimeLeadingZeroFormat());
            //$row->addText($notificationRow->to->displayName);

            $site = clone(ArchiveSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $row->addIconSite($site);


            $row->addClickableSite($notificationRow->subjectContent->getContentType()->getViewSite());

        }

        $btn=new AdminIconSiteButton($this);
        $btn->site = UserNotificationDeleteSite::$site;

        //$btn=new AdminSiteButton($this);
        //$btn->site = UserNotificationDeleteSite::$site;




        //$pagination = new BootstrapPagination($page);
        //$pagination->paginationReader = $reader;


        /*

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Subject';
        $th->content[LanguageCode::DE] = 'Betreff';

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Message';
        $th->content[LanguageCode::DE] = 'Nachricht';

        if ($this->showDateTime) {
            $th = new Th($header);
            $th->content[LanguageCode::EN] = 'Date';
            $th->content[LanguageCode::DE] = 'Datum';
        }

        //$header->addText('Message2');

        $header->addEmpty();

        $reader = new NotificationItemReader();

        foreach ($reader->getData() as $notificationItem) {

            $row = new BootstrapClickableTableRow($table);

            $row->addText($notificationItem->subject);
            $row->addText($notificationItem->message);
            //$row->addText($notificationItem->message2);

            if ($this->showDateTime) {
                $row->addText($notificationItem->dateTime->getShortDateTimeLeadingZeroFormat());
            }

            $site = clone(NotificationArchiveSite::$site);
            $site->addParameter(new NotificationParameter($notificationItem->id));
            $row->addIconSite($site);

            $row->addClickableSite($notificationItem->site);

        }*/

        return parent::getContent();

    }

}