<?php


namespace Nemundo\Process\Search\Content;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\App\Search\Parameter\SearchQueryParameter;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Text\TextBold;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Site\ContentItemSite;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexPaginationReader;

class SearchContentList extends AbstractContentList
{

    public function getContent()
    {

        //$form=new ContentSearchForm($this);


        $value = (new SearchQueryParameter())->getValue();
        $wordId = md5(mb_strtolower( $value));


        $textBold = new TextBold();
        $textBold->addSearchQuery($value);


        // redefine nach content type

        $reader = new SearchIndexPaginationReader();
        $reader->model->loadContent();
        $reader->model->content->loadContentType();

        foreach ($textBold->getWordIdList() as $wordId) {

            //(new Debug())->write($wordId);
        $reader->filter->orEqual($reader->model->wordId, $wordId);  // $form->getWordId());
        }

        $reader->paginationLimit=50;

        $table=new AdminClickableTable($this);

        foreach ($reader->getData() as $indexRow) {

            $row=new BootstrapClickableTableRow($table);

            $row->addText($indexRow->content->contentType->contentType);

            $row->addText($textBold->getBoldText( $indexRow->content->subject));

            //$site = $indexRow->content->contentType->getContentType()->getViewSite($indexRow->content->dataId);

            /*
            $site = clone(ContentItemSite::$site);
            $site->addParameter(new DataIdParameter($indexRow->contentId));
            $row->addClickableSite($site);*/

            $row->addClickableSite($this->getRedirectSite($indexRow->contentId));


        }



        return parent::getContent(); // TODO: Change the autogenerated stub
    }

}