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

        new UserNotificationInboxSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $nav = new AdminNavigation($page);
        $nav->site = UserNotificationSite::$site;


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


        $page->render();

    }


}