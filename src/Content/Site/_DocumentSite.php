<?php


namespace Nemundo\Process\Content\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Com\ListBox\ContentTypeListBox;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Process\Content\Data\Document\DocumentReader;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Web\Site\AbstractSite;

class DocumentSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Document';
        $this->url = 'document';

    }

    public function loadContent()
    {


        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new ContentTypeListBox($formRow);  // new BootstrapListBox($formRow);
        //$listbox->name = (new ContentTypeParameter())->parameterName;
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
        $header->addText('Subject');
        $header->addText('Date/Time');


        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->addOrder($reader->model->id, SortOrder::DESCENDING);

        $contentTypeParameter = new ContentTypeParameter();
        if ($contentTypeParameter->hasValue()) {
            $reader->filter->andEqual($reader->model->contentTypeId, $contentTypeParameter->getValue());
        }

        foreach ($reader->getData() as $contentRow) {

            if (class_exists($contentRow->contentType->phpClass)) {

                $contentType = $contentRow->contentType->getContentType();


                $row = new BootstrapClickableTableRow($table);
                $row->addText($contentRow->contentType->contentType);
                //$row->addText($contentRow->id);
                 $row->addText($contentRow->dataId);
                $row->addText($contentType->getSubject($contentRow->dataId));
                //$row->addText($contentRow->dateTimeCreated->getShortDateTimeFormat());

                $site = clone(ContentItemSite::$site);
                $site->addParameter(new DataIdParameter($contentRow->dataId));
                $row->addClickableSite($site);

            } else {
                (new LogMessage())->writeError('class does not exsits.Class:' . $contentRow->contentType->phpClass);
            }

        }


        $page->render();


    }


}