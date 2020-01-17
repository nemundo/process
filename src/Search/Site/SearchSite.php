<?php


namespace Nemundo\Process\Search\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\App\Search\Parameter\SearchQueryParameter;
use Nemundo\Com\TableBuilder\TableCell;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Text\TextBold;
use Nemundo\Db\Sql\Field\CountField;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Listing\BootstrapHyperlinkList;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Parameter\ContentTypeParameter;
use Nemundo\Process\Content\Parameter\DataParameter;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Content\Log\SearchLogContentType;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexCount;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexPaginationReader;
use Nemundo\Process\Text\BoldText;
use Nemundo\Web\Site\AbstractSite;

class SearchSite extends AbstractSite
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

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        //$dropdown = new ContentTypeDropdown($page);
        //$dropdown->redirectSite = ContentNewSite::$site;
        //$dropdown->addContentType(new ToDoProcess());
        //$dropdown->addContentType(new WikiPageContentType());


        $form = new ContentSearchForm($page);


        if ($form->hasValue()) {

            // redefine nach content type

            $searchIndexReader = new SearchIndexPaginationReader();
            $searchIndexReader->model->loadContent();
            $searchIndexReader->model->content->loadContentType();
            $searchIndexReader->filter->andEqual($searchIndexReader->model->wordId, $form->getWordId());

            $contentTypeParameter = new ContentTypeParameter();
            if ($contentTypeParameter->hasValue()) {
                $searchIndexReader->filter->andEqual($searchIndexReader->model->content->contentTypeId, $contentTypeParameter->getValue());
            }

            $searchIndexReader->paginationLimit = 50;


            // Search Filter

            $count = new SearchIndexCount();
            $count->filter->andEqual($searchIndexReader->model->wordId, $form->getWordId());
            $searchCount = $count->getCount();

            $p = new Paragraph($page);
            $p->content = $searchCount . ' Results found';


            $logType = new SearchLogContentType();
            $logType->searchQuery = $form->getSearchQuery();
            $logType->resultCount = $searchCount;
            $logType->saveType();


            $bold = new TextBold();
            $bold->addSearchQuery($form->getSearchQuery());


            $layout = new BootstrapTwoColumnLayout($page);

            $table = new AdminClickableTable($layout->col1);

            $header = new TableHeader($table);

            $th = new Th($header);
            $th->content[LanguageCode::EN]='Subject';
            $th->content[LanguageCode::DE]='Betreff';

            $th = new Th($header);
            $th->content[LanguageCode::EN]='Type';
            $th->content[LanguageCode::DE]='Typ';

            foreach ($searchIndexReader->getData() as $indexRow) {

                $row = new BootstrapClickableTableRow($table);

                $contentType = $indexRow->content->getContentType();
                $row->addText($bold->getBoldText( $contentType->getSubject()));
                $row->addText($indexRow->content->contentType->contentType);

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

            $searchIndexReader = new SearchIndexPaginationReader();
            $searchIndexReader->model->loadContent();
            $searchIndexReader->model->content->loadContentType();
            $searchIndexReader->filter->andEqual($searchIndexReader->model->wordId, $form->getWordId());
            $searchIndexReader->addGroup($searchIndexReader->model->content->contentTypeId);

            $count = new CountField($searchIndexReader);

            foreach ($searchIndexReader->getData() as $searchIndexRow) {

                $site = clone(SearchSite::$site);
                $site->addParameter(new SearchQueryParameter());
                $site->addParameter(new ContentTypeParameter($searchIndexRow->content->contentTypeId));
                $site->title = $searchIndexRow->content->contentType->contentType . ' (' . $searchIndexRow->getModelValue($count) . ')';
                $list->addSite($site);

            }

        }

        $page->render();

    }


}