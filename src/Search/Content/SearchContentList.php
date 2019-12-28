<?php


namespace Nemundo\Process\Search\Content;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\App\Search\Parameter\SearchQueryParameter;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Text\TextBold;
use Nemundo\Db\Sql\Field\DistinctField;
use Nemundo\Model\Join\ModelJoin;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroupModel;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Site\ContentItemSite;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\Process\Group\Data\GroupUser\GroupUserModel;
use Nemundo\Process\Search\Com\ContentSearchForm;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexPaginationReader;
use Nemundo\User\Type\UserSessionType;

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


        // DATA IN
        foreach ($textBold->getWordIdList() as $wordId) {
        $reader->filter->orEqual($reader->model->wordId, $wordId);  // $form->getWordId());
        }


        //$field = new DistinctField($reader);
        //$field->tableName = $reader->model->tableName;

        $contentGroupModel = new ContentGroupModel();
        $groupUserModel = new GroupUserModel();

        $join = new ModelJoin($reader);
        $join->type = $reader->model->contentId;
        $join->externalModel = $contentGroupModel;
        $join->externalType = $contentGroupModel->contentId;

        $join = new ModelJoin($reader);
        $join->type = $contentGroupModel->groupId;
        $join->externalModel = $groupUserModel;
        $join->externalType = $groupUserModel->groupId;

        $reader->filter->andEqual($groupUserModel->userId, (new UserSessionType())->userId);



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