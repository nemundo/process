<?php


namespace Nemundo\Process\App\Notification\Com\Container;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Layout\BootstrapThreeColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Process\App\Notification\Com\Table\UserNotificationTable;
use Nemundo\Process\App\Notification\Data\Notification\NotificationReader;
use Nemundo\Process\App\Notification\Filter\UserNotificationFilter;
use Nemundo\Process\App\Notification\Parameter\ArchiveParameter;
use Nemundo\Process\App\Notification\Site\UserNotificationDeleteSite;
use Nemundo\Process\App\Notification\Site\UserNotificationSite;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Web\Site\Site;

class UserNotificationContainer extends AbstractHtmlContainer
{

    public function getContent()
    {



        $form = new SearchForm($this);

        $formRow = new BootstrapFormRow($form);

        $listbox = new BootstrapListBox($formRow);
        $listbox->name=(new ArchiveParameter())->getParameterName();
        $listbox->emptyValueAsDefault = false;
        $listbox->addItem('0', 'Offene');
        $listbox->addItem('1', 'Gelöschte/Archivierte');
        //$listbox->addItem(2,'Gesendete');
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;


        $layout = new BootstrapThreeColumnLayout($this);
        $layout->col1->columnWidth= 2;
        $layout->col2->columnWidth= 10;
        $layout->col3->columnWidth= 0;

        $list=new BootstrapHyperlinkList($layout->col1);


        $reader =new NotificationReader();
        $reader->model->loadContentType();
        $reader->filter=new UserNotificationFilter(false);
        $reader->addGroup($reader->model->contentTypeId);

        $countField = new CountField($reader);

        foreach ($reader->getData() as $notificationRow) {

            $count =$notificationRow->getModelValue($countField);

            $site =new Site();  // clone(UserNotificationSite::$site);
            $site->addParameter(new ArchiveParameter());
            $site->addParameter(new ContentTypeParameter($notificationRow->contentTypeId));
            $site->title=$notificationRow->contentType->contentType.' ('.$count.')';
            $list->addSite($site);

        }

        $btn = new AdminSiteButton($layout->col2);
        $btn->site = UserNotificationDeleteSite::$site;


        new UserNotificationTable($layout->col2);




        return parent::getContent();
    }

}