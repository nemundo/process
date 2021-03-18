<?php


namespace Nemundo\Process\App\Document\Site;


use Nemundo\Admin\Com\Button\AdminSiteButton;
use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Title\AdminSubtitle;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Form\BootstrapFormRow;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Document\Com\DocumentTabs;
use Nemundo\Process\App\Document\Data\Document\DocumentPaginationReader;
use Nemundo\Process\App\Document\Data\DocumentType\DocumentTypeReader;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Com\Container\ContentChildContainer;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Workflow\Com\Container\WorkflowStreamContainer;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class DocumentSite extends AbstractSite
{

    /**
     * @var DocumentSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title = 'Document';
        $this->url = 'document';

        DocumentSite::$site = $this;

        new DocumentNewSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        new DocumentTabs($page);



        $form = new SearchForm($page);

        $formRow = new BootstrapFormRow($form);

        $listbox = new BootstrapListBox($formRow);
        $listbox->submitOnChange = true;
        $listbox->searchMode = true;

        $reader = new DocumentTypeReader();
        $reader->model->loadContentType();
        foreach ($reader->getData() as $documentTypeRow) {
            $listbox->addItem($documentTypeRow->contentTypeId, $documentTypeRow->contentType->contentType);
        }


        $layout=new BootstrapTwoColumnLayout($page);



        $documentReader = new DocumentPaginationReader();
        $documentReader->model->loadDocumentType();
        //$documentReader->model->documentType->loadContentType();
        $documentReader->model->loadContent();
        $documentReader->model->content->loadContentType();

        if ($listbox->hasValue()) {
            $documentReader->filter->andEqual($documentReader->model->content->contentTypeId, $listbox->getValue());
        }


        $documentReader->addOrder($documentReader->model->title);
        $documentReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;

        $table = new AdminClickableTable($layout->col1);

        $header = new AdminTableHeader($table);
        $header->addText($documentReader->model->title->label);
        $header->addText($documentReader->model->closed->label);
        $header->addText($documentReader->model->documentType->label);

        foreach ($documentReader->getData() as $documentRow) {

            $row = new BootstrapClickableTableRow($table);

            if ($documentRow->contentId == (new ContentParameter())->getValue()) {
                $row->addCssClass('table-active');
            }

            $row->addText($documentRow->title);
            $row->addYesNo($documentRow->closed);
            $row->addText($documentRow->documentType->contentType);
            //$row->addText($documentRow->content->dateTime->getShortDateTimeLeadingZeroFormat());*/

            //$contentType = $documentRow->content->getContentType();

            $site =new Site();  // clone(DocumentSite::$site);
            $site->addParameter(new ContentParameter($documentRow->contentId));
            $row->addClickableSite($site);
            //$row->addClickableSite($contentType->getViewSite());

        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $documentReader;


        $contentParameter=new ContentParameter();
        $contentParameter->contentTypeCheck=false;
        if ($contentParameter->exists()) {

            $contentType= $contentParameter->getContentType();

            $subtitle=new AdminSubtitle($layout->col2);
            $subtitle->content = $contentType->getSubject();

            $contentType->getView($layout->col2);




            $table = new ContentChildContainer($layout->col2);
            $table->contentType=$contentType;


            $btn = new AdminSiteButton($layout->col2);
            $btn->site = $contentType->getSubjectViewSite();


            // share
            // favorite
            // open


        }




        $page->render();


    }

}