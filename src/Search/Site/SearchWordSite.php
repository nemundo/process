<?php


namespace Nemundo\Process\Search\Site;


use Nemundo\Admin\Com\Table\AdminTable;
use Nemundo\Com\FormBuilder\SearchForm;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Com\ListBox\ContentTypeListBox;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Search\Data\ContentTypeWord\ContentTypeWordPaginationReader;
use Nemundo\Process\Search\Data\WordContentType\WordContentTypePaginationReader;
use Nemundo\Process\Search\Data\WordContentType\WordContentTypeReader;
use Nemundo\Web\Site\AbstractSite;

class SearchWordSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Search Word';
        $this->url = 'search-word';
        // TODO: Implement loadSite() method.
    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $form = new SearchForm($page);

        $contentType = new ContentTypeListBox($form);
        $contentType->searchMode = true;
        $contentType->submitOnChange = true;

        $table = new AdminTable($page);

        $reader = new WordContentTypePaginationReader();
        $reader->model->loadContentType();
        $reader->addOrder($reader->model->word);
        $reader->paginationLimit=ProcessConfig::PAGINATION_LIMIT;

        $parameter = new ContentTypeParameter();
        if ($parameter->hasValue()) {
            $reader->filter->andEqual($reader->model->contentTypeId, $parameter->getValue());
        }

        $header = new TableHeader($table);
        $header->addText($reader->model->word->label);
        $header->addText($reader->model->contentType->label);

        foreach ($reader->getData() as $wordRow) {

            $row = new TableRow($table);
            $row->addText($wordRow->word);
            $row->addText($wordRow->contentType->contentType);


        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader=$reader;

        //}


        $page->render();


    }

}