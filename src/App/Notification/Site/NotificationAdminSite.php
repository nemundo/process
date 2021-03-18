<?php


namespace Nemundo\Process\App\Notification\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Notification\Data\Notification\NotificationPaginationReader;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\Web\Site\AbstractSite;

class NotificationAdminSite extends AbstractSite
{

    /**
     * @var NotificationAdminSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Notification Admin';
        $this->url = 'notification-admin';

        NotificationAdminSite::$site = $this;


    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $user = new UserListBox($formRow);
        $user->submitOnChange = true;
        $user->searchMode = true;

        $notificationReader = new NotificationPaginationReader();
        $notificationReader->model->loadCategory();
        $notificationReader->model->loadContent();
        $notificationReader->model->content->loadContentType();
        $notificationReader->model->loadTo();

        if ($user->hasValue()) {
            $notificationReader->filter->andEqual($notificationReader->model->toId, $user->getValue());
        }

        $notificationReader->addOrder($notificationReader->model->id, SortOrder::DESCENDING);
        $notificationReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;


        $table = new AdminClickableTable($page);

        $header = new AdminTableHeader($table);
        $header->addText($notificationReader->model->archive->label);
        $header->addText($notificationReader->model->category->label);
        $header->addText('Type');
        $header->addText('Subject');
        $header->addText('Message');
        $header->addText('Date/Time');
        $header->addText('To');

        foreach ($notificationReader->getData() as $notificationRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addYesNo($notificationRow->archive);
            $row->addText($notificationRow->category->category);

            $row->addText($notificationRow->content->contentType->contentType);
            $row->addText($notificationRow->subject);
            $row->addText($notificationRow->message);

            $row->addText($notificationRow->content->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($notificationRow->to->displayName);

            $row->addClickableSite($notificationRow->content->getContentType()->getViewSite());

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $notificationReader;

        $page->render();

    }

}