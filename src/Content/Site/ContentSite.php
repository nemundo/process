<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Template\Site\ProcessTemplateSite;
use Nemundo\Web\Site\AbstractSite;

class ContentSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Content';
        $this->url = 'content';

        new ContentItemSite($this);

        new ProcessTemplateSite($this);


    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new BootstrapListBox($formRow);
        $listbox->name = (new ContentTypeParameter())->parameterName;
        $listbox->submitOnChange = true;
        $listbox->searchItem = true;

        $reader = new ContentTypeReader();
        foreach ($reader->getData() as $contentTypeRow) {
            $listbox->addItem($contentTypeRow->id, $contentTypeRow->phpClass);
        }



        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Php Class');
        $header->addText('Id');
        $header->addText('Parent Id');
        $header->addText('Data Id');


        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->addOrder($reader->model->id, SortOrder::DESCENDING);

        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->hasValue()) {
            $reader->filter->andEqual($reader->model->contentTypeId, $contentTypeParameter->getValue());
        }

        foreach ($reader->getData() as $contentRow) {


            $contentType = $contentRow->contentType->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($contentRow->contentType->phpClass);
            $row->addText($contentRow->id);
            $row->addText($contentRow->parentId);
            $row->addText($contentRow->dataId);
            $row->addText($contentType->getSubject($contentRow->dataId));
            $row->addText($contentRow->dateTimeCreated->getShortDateTimeFormat());

            $site = clone(ContentItemSite::$site);
            $site->addParameter(new DataIdParameter($contentRow->dataId));
            $row->addClickableSite($site);

        }


        $page->render();


    }


}