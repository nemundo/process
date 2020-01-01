<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\ListBox\ContentTypeListBox;
use Nemundo\Process\Content\Data\Content\ContentPaginationReader;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Item\ContentItem;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Web\Site\AbstractSite;

class ContentSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Content';
        $this->url = 'content';

        new ContentItemSite($this);
        new ContentNewSite($this);
        new ContentDeleteSite($this);

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new ContentTypeListBox($formRow);
        //$listbox->name = (new ContentTypeParameter())->parameterName;
        $listbox->submitOnChange = true;
        $listbox->searchItem = true;

        /*
        $reader = new ContentTypeReader();
        foreach ($reader->getData() as $contentTypeRow) {
            $listbox->addItem($contentTypeRow->id, $contentTypeRow->phpClass);
        }*/


        $btn=new AdminSiteButton($page);
        $btn->site=ContentNewSite::$site;



        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Content Type');
        $header->addText('Data Id');
        $header->addText('Subject (Db Content)');
        $header->addText('Subject (Item)');
        $header->addText('Date/Time');
        $header->addText('User');
        $header->addEmpty();


        $contentReader = new ContentPaginationReader();
        $contentReader->model->loadContentType();
        $contentReader->model->loadUser();
        $contentReader->addOrder($contentReader->model->dateTime, SortOrder::DESCENDING);
        $contentReader->paginationLimit=50;

        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->hasValue()) {
            $contentReader->filter->andEqual($contentReader->model->contentTypeId, $contentTypeParameter->getValue());
        }

        foreach ($contentReader->getData() as $contentRow) {

            if (class_exists($contentRow->contentType->phpClass)) {

                $contentType = $contentRow->contentType->getContentType($contentRow->id);


                $row = new BootstrapClickableTableRow($table);
                //$row->addText($contentRow->contentType->phpClass);
                $row->addText($contentRow->contentType->contentType);
                $row->addText($contentType->getClassName());

                $row->addText($contentRow->id);

                $row->addText($contentRow->subject);

                //$row->addText($contentRow->parentId);
                //$row->addText($contentRow->id);

                //$item = new ContentItem($contentRow->id);
                //$item->contentType = $contentType;

                //$item = $contentType->getItem($contentRow->id);

                $row->addText($contentType->getClassName());
                $row->addText($contentType->getSubject());

                //$row->addText($contentType->getSubject($contentRow->id));


                $row->addText($contentRow->dateTime->getShortDateTimeFormat());
                $row->addText($contentRow->user->login);


                $site = ContentDeleteSite::$site;
                $site->addParameter(new DataIdParameter($contentRow->id));
                $row->addIconSite($site);

                $site = clone(ContentItemSite::$site);
                $site->addParameter(new DataIdParameter($contentRow->id));
                $row->addClickableSite($site);

            } else {
                (new LogMessage())->writeError('class does not exsits.Class:' . $contentRow->contentType->phpClass);
            }

        }


        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader= $contentReader;


        $page->render();


    }


}