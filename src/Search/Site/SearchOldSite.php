<?php


namespace Nemundo\Process\Search\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Table\AdminTableHeader;
use Nemundo\Core\Debug\Debug;
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
use Nemundo\Process\Search\Site\Json\SearchContentTypeJsonSite;
use Nemundo\Process\Search\Site\Json\SearchJsonSite;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class SearchOldSite extends AbstractSite
{

    /**
     * @var SearchSite
     */
    public static $site;

    protected function loadSite()
    {
        $this->title[LanguageCode::EN] = 'Search';
        $this->title[LanguageCode::DE] = 'Suche';
        $this->url = 'search';
        SearchSite::$site = $this;

        new SearchItemSite($this);
        new SearchJsonSite($this);
        new SearchContentTypeJsonSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        new ContentSearchForm($page);

        $queryParameter = (new SearchQueryParameter());

        if ($queryParameter->hasValue()) {

            $searchIndexReader = new SearchIndexPaginationReader();
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


            $searchCount = $count->getFormatCount();  //getCount();


            $resultText = [];
            $resultText[LanguageCode::EN] = 'Results found';
            $resultText[LanguageCode::DE] = 'Ergebnisse gefunden';

            $p = new Paragraph($page);
            $p->content = $searchCount . ' ' . (new Translation())->getText($resultText);


            /*$logType = new SearchLogContentType();
            $logType->searchQuery =(new SearchQueryParameter())->getValue();  // $queryParameter->getSearchQuery();
            $logType->resultCount = $searchCount;
            $logType->saveType();*/


            $bold = new TextBold();
            $bold->addSearchQuery((new SearchQueryParameter())->getValue());  //$form->getSearchQuery());


            $layout = new BootstrapTwoColumnLayout($page);
            $layout->col1->columnWidth = 10;
            $layout->col2->columnWidth = 2;


            $table = new AdminClickableTable($layout->col1);

            $header = new AdminTableHeader($table);

            /*$th = new Th($header);
            $th->content[LanguageCode::EN] = 'Source';
            $th->content[LanguageCode::DE] = 'Quelle';*/

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
            $pagination->paginationReader = $searchIndexReader;


            // Alle Anzeigen

            $list = new BootstrapHyperlinkList($layout->col2);

            $label = 'Alle Resultate (' . $searchCount . ')';
            if ((new ContentTypeParameter())->notExists()) {
                $list->addActiveHyperlink($label);
            } else {

                $site = new Site();
                $site->title = $label;
                $site->removeParameter(new ContentTypeParameter());
                $list->addSite($site);
            }

            $searchIndexReader = new SearchIndexPaginationReader();
            $searchIndexReader->model->loadContent();
            $searchIndexReader->model->content->loadContentType();

            /*
            $filter=new Filter();

            $keyowrdList=new KeywordList();
            $keyowrdList->addInputText=false;
            foreach ( $keyowrdList->getHashList($queryParameter->getValue()) as $value ) {
                (new Debug())->write($value);
                $filter->orEqual($searchIndexReader->model->wordId, $value);
            }

            $searchIndexReader->filter->andFilter($filter);*/

            //$searchIndexReader->filter->andEqual($searchIndexReader->model->wordId, $queryParameter->getWordId());

            $searchIndexReader->filter->andFilter($keywordFilter);
            $searchIndexReader->addGroup($searchIndexReader->model->content->contentTypeId);

            $count = new CountField($searchIndexReader);

            foreach ($searchIndexReader->getData() as $searchIndexRow) {


                $label = $searchIndexRow->content->contentType->contentType . ' (' . $searchIndexRow->getModelValue($count) . ')';

                if ((new ContentTypeParameter())->getValue() == $searchIndexRow->content->contentTypeId) {
                    $list->addActiveHyperlink($label);
                } else {

                    $site = clone(SearchSite::$site);
                    $site->addParameter(new SearchQueryParameter());
                    $site->addParameter(new ContentTypeParameter($searchIndexRow->content->contentTypeId));
                    $site->title = $label;
                    $list->addSite($site);
                }

            }

        }

        $page->render();

    }

}