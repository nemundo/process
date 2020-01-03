<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Language\Translation;
use Nemundo\Process\App\Inbox\Data\Inbox\Inbox;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Tree\TreeDelete;


// AbstractContentTreeContentType
abstract class AbstractTreeContentType extends AbstractContentType
{

    use ContentTreeTrait;

    //use SearchIndexTrait;

    /**
     * @var string
     */
    public $parentId;


     public function saveType()
    {

        $this->saveData();
        $this->saveContent();

        return $this->dataId;

    }



    protected function loadItem()
    {

    }



    // recursives löschen
    // deleteType
    public function deleteType()
    {

        (new ContentDelete())->deleteById($this->dataId);

        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->dataId);
        $delete->filter->orEqual($delete->model->childId, $this->dataId);
        $delete->delete();

        $this->deleteSearchIndex();

        /*
        $delete = new SearchIndexDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->dataId);
        $delete->delete();*/


        // delete child
        // kann mehrere items beinhalten !!!

    }


    public function sendToInbox($userId)
    {

        $data = new Inbox();
        $data->userId = $userId;
        $data->contentTypeId = $this->contentId;
        $data->dataId = $this->dataId;
        $data->save();

    }


    public function sendToTask()
    {


    }





    public function getText()
    {

        $text = '[No Text]';
        return $text;


    }


}