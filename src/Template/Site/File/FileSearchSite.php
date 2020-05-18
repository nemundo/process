<?php


namespace Nemundo\Process\Template\Site\File;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexPaginationReader;
use Nemundo\Process\Search\Parameter\SearchQueryParameter;
use Nemundo\Process\Search\Reader\SearchItemReader;
use Nemundo\Process\Template\Content\File\FileContentType;
use Nemundo\Web\Site\AbstractSite;
use Schleuniger\App\Aufgabe\Content\Process\AufgabeProcess;

class FileSearchSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->title = 'File Search';
        $this->url = 'file-search2';

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        //new FileContentDropzoneUploadForm($page);

        new ContentSearchForm($page);

        $queryParameter = (new SearchQueryParameter());

        //if ($queryParameter->hasValue()) {

        $reader = new SearchItemReader();
        $reader->query = $queryParameter->getValue();
        $reader->returnEmptyResult = true;
        $reader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;

        $reader->addFilterContentType(new FileContentType());
        //$reader->addFilterContentType(new AufgabeProcess());

        $p = new Paragraph($page);
        $p->content = $reader->getTotalCount() . ' Items found';

        $table = new AdminClickableTable($page);

        foreach ($reader->getData() as $searchItem) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($searchItem->subject);
            $row->addText($searchItem->text);
            //$row->addText($searchItem->typeLabel);
            $row->addClickableSite($searchItem->site);

        }

        $pagination=new BootstrapPagination($page);
        $pagination->paginationReader=$reader;

        $page->render();



    }

}