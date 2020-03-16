<?php


namespace Nemundo\Process\App\Notification\Com\Table;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Notification\Data\Notification\NotificationPaginationReader;
use Nemundo\Process\App\Notification\Filter\UserNotificationFilter;
use Nemundo\Process\App\Notification\Parameter\NotificationParameter;
use Nemundo\Process\App\Notification\Site\ArchiveSite;
use Nemundo\Process\App\Notification\Site\RedirectSite;
use Nemundo\Process\Config\ProcessConfig;

class UserNotificationTable extends AbstractHtmlContainer
{

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


        $notificationReader = new NotificationPaginationReader();
        $notificationReader->model->loadContent();
        $notificationReader->model->content->loadContentType();
        $notificationReader->filter = new UserNotificationFilter();
        $notificationReader->addOrder($notificationReader->model->id, SortOrder::DESCENDING);
        $notificationReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;
        foreach ($notificationReader->getData() as $notificationRow) {

            $row = new BootstrapClickableTableRow($table);

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

            $site = clone(RedirectSite::$site);
            $site->addParameter(new NotificationParameter($notificationRow->id));
            $row->addClickableSite($site);

        }

        $pagination = new BootstrapPagination($this);
        $pagination->paginationReader = $notificationReader;

        return parent::getContent();

    }

}