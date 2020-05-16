<?php


namespace Nemundo\Process\Template\Site\File;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\Text\KeywordList;
use Nemundo\Core\Text\SnippetText;
use Nemundo\Core\Text\TextBold;
use Nemundo\Db\Filter\Filter;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Config\ProcessConfig;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexCount;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexPaginationReader;
use Nemundo\Process\Search\Parameter\SearchQueryParameter;
use Nemundo\Process\Search\Reader\SearchItemReader;
use Nemundo\Process\Search\Site\SearchItemSite;
use Nemundo\Process\Search\Site\SearchSite;
use Nemundo\Process\Template\Com\Form\FileContentDropzoneUploadForm;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class FileSearchSite extends AbstractSite
{

    protected function loadSite()
    {

        $this->title='File Search';
        $this->url='file-search2';

        // TODO: Implement loadSite() method.
    }



    public function loadContent()
    {

        $page=(new DefaultTemplateFactory())->getDefaultTemplate();


        //new FileContentDropzoneUploadForm($page);


        new ContentSearchForm($page);

        $queryParameter = (new SearchQueryParameter());

        if ($queryParameter->hasValue()) {





            $reader = new SearchItemReader();
            foreach ($reader->getData() as $searchItem) {




            }


            /*

             $searchIndexReader->model->loadContent();
            $searchIndexReader->model->content->loadContentType();

            //$searchIndexReader->filter->andEqual($searchIndexReader->model->wordId, $queryParameter->getWordId());


            $keywordFilter=new Filter();

            $keyowrdList=new KeywordList();
            $keyowrdList->addInputText=false;
            foreach ( $keyowrdList->getHashList($queryParameter->getValue()) as $value ) {
                $keywordFilter->orEqual($searchIndexReader->model->wordId, $value);
            }

            $searchIndexReader->filter->andFilter($keywordFilter);

            $contentTypeParameter = new ContentTypeParameter();
            if ($contentTypeParameter->hasValue()) {
                $searchIndexReader->filter->andEqual($searchIndexReader->model->content->contentTypeId, $contentTypeParameter->getValue());
            }


            $searchIndexReader->addGroup($searchIndexReader->model->contentId);
            $searchIndexReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;


            $count = new SearchIndexCount();
            $count->filter->andFilter($keywordFilter);

            //$count->filter->andEqual($searchIndexReader->model->wordId, $queryParameter->getWordId());


            $searchCount = $count->getCount();

            $searchIndexReader = new SearchIndexPaginationReader();
            $searchIndexReader->model->loadContent();
            $searchIndexReader->model->content->loadContentType();

            $keywordFilter=new Filter();

            $keyowrdList=new KeywordList();
            $keyowrdList->addInputText=false;
            foreach ( $keyowrdList->getHashList($queryParameter->getValue()) as $value ) {
                $keywordFilter->orEqual($searchIndexReader->model->wordId, $value);
            }

            $searchIndexReader->filter->andFilter($keywordFilter);

            $contentTypeParameter = new ContentTypeParameter();
            if ($contentTypeParameter->hasValue()) {
                $searchIndexReader->filter->andEqual($searchIndexReader->model->content->contentTypeId, $contentTypeParameter->getValue());
            }


            $searchIndexReader->addGroup($searchIndexReader->model->contentId);
            $searchIndexReader->paginationLimit = ProcessConfig::PAGINATION_LIMIT;


            $count = new SearchIndexCount();
            $count->filter->andFilter($keywordFilter);


            $searchCount = $count->getCount();


            $resultText = [];
            $resultText[LanguageCode::EN] = 'Results found';
            $resultText[LanguageCode::DE] = 'Ergebnisse gefunden';

            $p = new Paragraph($page);
            $p->content = $searchCount . ' ' . (new Translation())->getText($resultText);


            $bold = new TextBold();
            $bold->addSearchQuery((new SearchQueryParameter())->getValue());  //$form->getSearchQuery());


            $layout = new BootstrapTwoColumnLayout($page);
            $layout->col1->columnWidth = 10;
            $layout->col2->columnWidth = 2;


            $table = new AdminClickableTable($layout->col1);

            $header = new TableHeader($table);



            $th = new Th($header);
            $th->content[LanguageCode::EN] = 'Subject';
            $th->content[LanguageCode::DE] = 'Betreff';

            $th = new Th($header);
            $th->content[LanguageCode::EN] = 'Type';
            $th->content[LanguageCode::DE] = 'Typ';

            $th = new Th($header);
            $th->content = 'Text';

            foreach ($searchIndexReader->getData() as $indexRow) {

                $row = new BootstrapClickableTableRow($table);

                $contentType = $indexRow->content->getContentType();

                $row->addText($bold->getBoldText($contentType->getSubject()));
                $row->addText($indexRow->content->contentType->contentType);

                $snippet = new SnippetText();
                $textSnippet = $snippet->getSnippet($queryParameter->getValue(), $contentType->getText());
                $row->addText($bold->getBoldText($textSnippet));

                if ($contentType->hasViewSite()) {
                    $site = $contentType->getViewSite();
                    $row->addClickableSite($site);
                } else {
                    $site = clone(SearchItemSite::$site);
                    $site->addParameter(new ContentParameter($indexRow->contentId));
                    $row->addClickableSite($site);
                }

            }

            $pagination = new BootstrapPagination($layout->col1);
            $pagination->paginationReader = $searchIndexReader;*/


        }

        $page->render();




        // TODO: Implement loadContent() method.
    }

}