<?php


namespace Nemundo\Process\App\Document\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Document\Data\Document\DocumentPaginationReader;
use Nemundo\Process\App\Document\Data\DocumentType\DocumentTypeReader;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Web\Site\AbstractSite;

class DocumentSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Document Index';
        $this->url = 'document-index';
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new BootstrapListBox($formRow);
        $listbox->submitOnChange = true;
        $listbox->searchMode=true;

        $reader = new DocumentTypeReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $documentTypeRow) {
            $listbox->addItem($documentTypeRow->contentTypeId, $documentTypeRow->contentType->contentType);
        }

        $documentReader = new DocumentPaginationReader();
        $documentReader->model->loadDocumentType();
        //$documentReader->model->documentType->loadContentType();
        $documentReader->model->loadContent();
        $documentReader->model->content->loadContentType();

        if ($listbox->hasValue()) {
            $documentReader->filter->andEqual($documentReader->model->content->contentTypeId, $listbox->getValue());
        }


        $documentReader->addOrder($documentReader->model->title);
        $documentReader->paginationLimit=ProcessConfig::PAGINATION_LIMIT;

        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText($documentReader->model->title->label);
        $header->addText($documentReader->model->closed->label);
        $header->addText($documentReader->model->documentType->label);

        foreach ($documentReader->getData() as $documentRow) {

            $row = new BootstrapClickableTableRow($table);

            $row->addText($documentRow->title);
            $row->addYesNo($documentRow->closed);
            $row->addText($documentRow->documentType->contentType);
            //$row->addText($documentRow->content->dateTime->getShortDateTimeLeadingZeroFormat());*/

            $contentType = $documentRow->content->getContentType();
            $row->addClickableSite($contentType->getViewSite());

        }

        $pagination=new BootstrapPagination($page);
        $pagination->paginationReader=$documentReader;


        $page->render();


    }

}