<?php


namespace Nemundo\Process\Search\Site;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\Content\Com\Dropdown\ContentTypeDropdown;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Site\ContentItemSite;
use Nemundo\Process\Content\Site\ContentNewSite;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexPaginationReader;
use Nemundo\ToDo\Workflow\Process\ToDoProcess;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Web\Site\Site;

class SearchSite extends AbstractSite
{

    protected function loadSite()
    {
        $this->title = 'Search';
        $this->url = 'search';

        new SearchJsonSite($this);

    }


    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();


        $dropdown = new ContentTypeDropdown($page);
        $dropdown->redirectSite = ContentNewSite::$site;
        $dropdown->addContentType(new ToDoProcess());
        $dropdown->addContentType(new WikiPageContentType());


        $form = new ContentSearchForm($page);


        // redefine nach content type

        $reader = new SearchIndexPaginationReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();
        $reader->filter->andEqual($reader->model->wordId, $form->getWordId());
        $reader->paginationLimit = 50;

        $table = new AdminClickableTable($page);

        foreach ($reader->getData() as $indexRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($indexRow->content->contentType->contentType);
            $row->addText($indexRow->content->subject);

            $contentType =  $indexRow->content->contentType->getContentType();
            if ($contentType->hasViewSite()) {
                $site = $contentType->getViewSite($indexRow->contentId);
                $row->addClickableSite($site);
            } else {
                $site =  clone(ContentItemSite::$site);
                $site->addParameter(new DataIdParameter($indexRow->contentId));
                $row->addClickableSite($site);
            }

        }

        $page->render();

    }


}