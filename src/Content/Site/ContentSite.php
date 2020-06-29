<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminSearchButton;
use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\App\Application\Com\ApplicationListBox;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Type\Number\Number;
use Nemundo\Db\Filter\Filter;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapTextBox;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Com\ListBox\ContentTypeListBox;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Content\Data\Content\ContentPaginationReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\User\Com\ListBox\UserListBox;
use Nemundo\Web\Site\AbstractSite;

class ContentSite extends AbstractSite
{

    /**
     * @var ContentSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title = 'Content';
        $this->url = 'content';

        ContentSite::$site = $this;

        new ContentTypeSite($this);
        new ContentCheckSite($this);

        new ContentItemSite($this);
        new ContentNewSite($this);
        new ContentDeleteSite($this);
        new RemoveContentSite($this);
        new ContentIndexSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $nav = new AdminNavigation($page);
        $nav->site = ContentSite::$site;


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $application=new ApplicationListBox($formRow);
        $application->submitOnChange = true;
        $application->searchMode = true;

        $listbox = new ContentTypeListBox($formRow);
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;

        $contentIdTextBox = new BootstrapTextBox($formRow);
        $contentIdTextBox->label = 'Content Id';
        $contentIdTextBox->searchMode = true;

        $dataIdTextBox = new BootstrapTextBox($formRow);
        $dataIdTextBox->label = 'Data Id';
        $dataIdTextBox->searchMode = true;

        $user = new UserListBox($formRow);
        $user->submitOnChange = true;
        $user->searchMode = true;

        $subject = new BootstrapTextBox($formRow);
        $subject->label = 'Subject';
        $subject->searchMode = true;


        new AdminSearchButton($formRow);


        /*
        $reader = new ContentTypeReader();
        foreach ($reader->getData() as $contentTypeRow) {
            $listbox->addItem($contentTypeRow->id, $contentTypeRow->phpClass);
        }*/


        $btn = new AdminSiteButton($page);
        $btn->site = ContentNewSite::$site;


        $contentReader = new ContentPaginationReader();
        $contentReader->model->loadContentType();
        $contentReader->model->contentType->loadApplication();
        $contentReader->model->loadUser();

        $filter = new Filter();
        $model = new ContentModel();

        if ($application->hasValue()) {
            $filter->andEqual($contentReader->model->contentType->applicationId, $application->getValue());
        }


        $contentTypeParameter = new ContentTypeParameter();
        $contentTypeParameter->contentTypeCheck = false;
        if ($contentTypeParameter->hasValue()) {

            $filter->andEqual($model->contentTypeId, $contentTypeParameter->getValue());


            $contentType = $contentTypeParameter->getContentType();

            $table = new AdminLabelValueTable($page);
            $table->addLabelValue('Class', $contentType->getClassName());
            $table->addLabelValue('Type Label', $contentType->typeLabel);
            $table->addLabelValue('Type Id', $contentType->typeId);

            $btn = new AdminSiteButton($page);
            $btn->site = clone(RemoveContentSite::$site);
            $btn->site->addParameter($contentTypeParameter);

        }

        if ($contentIdTextBox->hasValue()) {
            $filter->andEqual($model->id, $contentIdTextBox->getValue());
        }

        if ($dataIdTextBox->hasValue()) {
            $filter->andEqual($model->dataId, $dataIdTextBox->getValue());
        }

        if ($user->hasValue()) {
            $filter->andEqual($model->userId, $user->getValue());
        }

        if ($subject->hasValue()) {
            $filter->andEqual($model->subject, $subject->getValue());
        }


        $count = new ContentCount();
        $count->model->loadContentType();
        $count->filter = $filter;
        $contentCount = $count->getCount();


        $p = new Paragraph($page);
        $p->content = (new Number($contentCount))->formatNumber() . ' Content found';



        $contentReader->filter = $filter;
        $contentReader->addOrder($contentReader->model->id, SortOrder::DESCENDING);
        $contentReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;

        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText($contentReader->model->contentType->application->label);
        $header->addText('Content Id');
        $header->addText('Type');
        $header->addText('Type Id');
        $header->addText('Class');
        $header->addText('Data Id');
        $header->addText('Subject (Data)');
        $header->addText('Subject (Type)');
        $header->addText('Date/Time');
        $header->addText('User');
        $header->addEmpty();


        foreach ($contentReader->getData() as $contentRow) {

            $contentType = $contentRow->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($contentRow->contentType->application->application);

            $row->addText($contentRow->id);
            $row->addText($contentRow->contentType->contentType);
            $row->addText($contentRow->contentTypeId);
            $row->addText($contentType->getClassName());
            $row->addText($contentRow->dataId);
            $row->addText($contentRow->subject);
            $row->addText($contentType->getSubject());
            $row->addText($contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
            $row->addText($contentRow->user->login);

            $site = clone(ContentIndexSite::$site);
            $site->addParameter(new ContentParameter($contentRow->id));
            $row->addSite($site);


            $site = clone(ContentDeleteSite::$site);
            $site->addParameter(new ContentParameter($contentRow->id));
            $row->addIconSite($site);

            $site = clone(ContentItemSite::$site);
            $site->addParameter(new ContentParameter($contentRow->id));
            $row->addClickableSite($site);

        }


        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $contentReader;


        $page->render();


    }


}