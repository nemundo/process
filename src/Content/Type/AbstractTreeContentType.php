<?php


namespace Nemundo\Process\Content\Item;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Db\Sql\Order\SortOrder;
use Nemundo\Process\App\Inbox\Data\Inbox\Inbox;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentRow;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroup;
use Nemundo\Process\Content\Data\Tree\Tree;
use Nemundo\Process\Content\Data\Tree\TreeCount;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Data\Tree\TreeReader;
use Nemundo\Process\Content\Data\Tree\TreeValue;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Group\Type\PublicGroup;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;
use Nemundo\Process\Search\Index\SearchIndexBuilder;
use Nemundo\User\Type\UserSessionType;


// AbstractContentTreeContentType
abstract class AbstractTreeContentType extends AbstractContentType
{

    /**
     * @var string
     */
    public $parentId;

    /**
     * @var AbstractContentType
     */
    //public $contentType;

    /**
     * @var DateTime
     */
   // public $dateTime;

    /**
     * @var string
     */
   // public $userId;

    /**
     * @var string
     */
    //public $dataId;


    //private $createMode = false;


    abstract protected function saveData();

    public function __construct($id = null)
    {

        if ($id == null) {
            $this->dataId = (new UniqueId())->getUniqueId();
            //$this->createMode = true;
        } else {

            $this->dataId = $id;
            //$this->loadData();

        }

        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;

        $this->loadItem();

    }


    public function saveType()
    {

        $this->saveData();

        if ($this->contentType == null) {
            (new LogMessage())->writeError('No Content Type.' . $this->getClassName());
        }

        $this->saveContent();




    }


    //protected function save



    public function addSearchWord($word)
    {

        if ($this->searchIndex == null) {
            $this->searchIndex = new SearchIndexBuilder($this->dataId);
        }

        $this->searchIndex->addWord($word);

    }

    public function addSearchText($text)
    {


        if ($this->searchIndex == null) {
            $this->searchIndex = new SearchIndexBuilder($this->dataId);
        }

        $this->searchIndex->addText($text);

    }


    protected function loadItem()
    {

    }



    public function hasParent()
    {

        $value = false;
        if ($this->getParentCount() > 0) {
            $value = true;
        }
        return $value;

    }


    public function addChild($childId)
    {

        $value = new TreeValue();
        $value->field = $value->model->itemOrder;
        $value->filter->andEqual($value->model->parentId, $this->dataId);
        $itemOrder = $value->getMaxValue();

        if ($itemOrder == '') {
            $itemOrder = -1;
        }
        $itemOrder++;

        $data = new Tree();
        $data->parentId = $this->dataId;
        $data->childId = $childId;
        $data->itemOrder = $itemOrder;
        $data->save();


    }


    public function getChildReverse()
    {

        return $this->getChildContent(SortOrder::DESCENDING);
    }


    public function getChild()
    {

        return $this->getChildContent(SortOrder::ASCENDING);

    }


    public function getChildCount()
    {

        $count = new TreeCount();
        $count->filter->andEqual($count->model->parentId, $this->dataId);
        return $count->getCount();

    }


    public function getParentCount()
    {

        $count = new TreeCount();
        $count->filter->andEqual($count->model->childId, $this->dataId);
        return $count->getCount();

    }


    private function getChildContent($sortOrder = SortOrder::DESCENDING)
    {

        $reader = new TreeReader();
        $reader->model->loadChild();
        $reader->model->child->loadContentType();
        $reader->model->child->loadUser();
        $reader->filter->andEqual($reader->model->parentId, $this->dataId);

        /** @var ContentRow[] $doc */
        $doc = [];
        foreach ($reader->getData() as $treeRow) {
            $doc[] = $treeRow->child;
        }

        return $doc;

    }


    public function getParentContent()
    {

        $reader = new TreeReader();
        $reader->model->loadParent();
        $reader->model->parent->loadContentType();
        $reader->filter->andEqual($reader->model->childId, $this->dataId);

        /** @var ContentRow[] $doc */
        $doc = [];
        foreach ($reader->getData() as $treeRow) {
            $doc[] = $treeRow->parent;
        }

        return $doc;

    }


    public function removeFromParent()
    {


    }


    // recursives löschen
    public function deleteItem()
    {

        (new ContentDelete())->deleteById($this->dataId);

        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->dataId);
        $delete->filter->orEqual($delete->model->childId, $this->dataId);
        $delete->delete();


        $delete = new SearchIndexDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->dataId);
        $delete->delete();


        // delete child
        // kann mehrere items beinhalten !!!

    }


    public function sendToInbox($userId)
    {

        $data = new Inbox();
        $data->userId = $userId;
        $data->contentTypeId = $this->contentType->contentId;
        $data->dataId = $this->dataId;
        $data->save();

    }


    public function sendToTask()
    {


    }


    public function getSubject()
    {


        $subject = '[No Content Type]';

        if ($this->contentType !== null) {
            $subject = (new Translation())->getText( $this->contentType->type);
        }

        return $subject;

        //return $this->contentType->getSubject($this->dataId);


    }


    public function getText() {

        $text='[No Text]';
        return $text;


    }



}