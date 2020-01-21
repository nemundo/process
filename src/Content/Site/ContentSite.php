<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Navigation\AdminNavigation;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Db\Filter\Filter;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\ListBox\ContentTypeListBox;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Content\ContentModel;
use Nemundo\Process\Content\Data\Content\ContentPaginationReader;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataParameter;
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

        ContentSite::$site=$this;

        new ContentItemSite($this);
        new ContentNewSite($this);
        new ContentDeleteSite($this);

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $nav = new AdminNavigation($page);
        $nav->site=ContentSite::$site;


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new ContentTypeListBox($formRow);
        //$listbox->name = (new ContentTypeParameter())->parameterName;
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;

        /*
        $reader = new ContentTypeReader();
        foreach ($reader->getData() as $contentTypeRow) {
            $listbox->addItem($contentTypeRow->id, $contentTypeRow->phpClass);
        }*/


        $btn = new AdminSiteButton($page);
        $btn->site = ContentNewSite::$site;


        $filter = new Filter();
        $model = new ContentModel();

        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->hasValue()) {
            $filter->andEqual($model->contentTypeId, $contentTypeParameter->getValue());

            $contentType = $contentTypeParameter->getContentType();

            $table = new AdminLabelValueTable($page);
            $table->addLabelValue('Class', $contentType->getClassName());

        }


        $count = new ContentCount();
        $count->filter = $filter;
        $contentCount = $count->getCount();


        $p = new Paragraph($page);
        $p->content = $contentCount . ' Content found';


        $contentReader = new ContentPaginationReader();
        $contentReader->model->loadContentType();
        $contentReader->model->loadUser();
        $contentReader->filter = $filter;
        $contentReader->addOrder($contentReader->model->id, SortOrder::DESCENDING);
        $contentReader->paginationLimit = 50;


        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('ID');
        $header->addText('Type');
        $header->addText('Class');
        $header->addText('Data Id');
        $header->addText('Subject (Data)');
        $header->addText('Subject (Type)');
        $header->addText('Date/Time');
        $header->addText('User');
        $header->addEmpty();


        foreach ($contentReader->getData() as $contentRow) {

            if (class_exists($contentRow->contentType->phpClass)) {


                $contentType = $contentRow->getContentType();  // contentType->getContentType($contentRow->id);


                $row = new BootstrapClickableTableRow($table);
                $row->addText($contentRow->id);
                $row->addText($contentRow->contentType->contentType);
                $row->addText($contentType->getClassName());
                $row->addText($contentRow->dataId);
                $row->addText($contentRow->subject);
                $row->addText($contentType->getSubject());
                $row->addText($contentRow->dateTime->getShortDateTimeWithSecondLeadingZeroFormat());
                $row->addText($contentRow->user->login);

                $site = clone(ContentDeleteSite::$site);
                $site->addParameter(new ContentParameter($contentRow->id));
                $row->addIconSite($site);

                $site = clone(ContentItemSite::$site);
                $site->addParameter(new ContentParameter($contentRow->id));
                $row->addClickableSite($site);

            } else {
                (new LogMessage())->writeError('class does not exsits.Class:' . $contentRow->contentType->phpClass);
            }

        }


        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $contentReader;


        $page->render();


    }


}