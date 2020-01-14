<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\App\Wiki\Parameter\WikiParameter;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentUpdate;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Writer\TreeContentWriter;
use Nemundo\Process\Content\Writer\TreeWriter;


abstract class AbstractTreeContentType extends AbstractContentType
{

    use ContentTreeTrait;

    /**
     * @var string
     */
    public $parentId;


    public function saveType()
    {


        /*$data = new Content();
        //$data->updateOnDuplicate = true;
        //$data->id =$contentId;  // (new Uniq) $this->dataId;
        //$data->dataId=$this->dataId;
        $data->contentTypeId = $this->typeId;
        //$data->subject = $this->subject;  //getSubject();
        $data->dateTime =$this->dateTime;
        $data->userId =$this->userId;
        $this->contentId= $data->save();*/

       // (new Debug())->write($this->createMode);

        if ($this->createMode) {

            $data = new Content();
            $data->contentTypeId = $this->typeId;
            $data->dateTime =$this->dateTime;
            $data->userId =$this->userId;
            $this->contentId= $data->save();

            $this->onCreate();

        } else {

            $this->onUpdate();

        }


        $update = new ContentUpdate();
        $update->dataId = $this->dataId;
        $update->updateById($this->contentId);


        if ($this->parentId !==null) {

        $writer=new TreeWriter();
        $writer->parentId=$this->parentId;
        $writer->dataId= $this->contentId; // $this->dataId;
        $writer->write();
        }

        $this->saveSearchIndex();


        /*
        $writer = new TreeContentWriter();
        $writer->contentType = $this;
        $writer->parentId = $this->parentId;
        $writer->dataId =  $this->dataId;
        $writer->subject = $this->getSubject();
     $contentId = $writer->write();

        $this->saveSearchIndex();*/


       // return $contentId;
        //return $this->dataId;

    }


    public function deleteType()
    {

        parent::deleteType();

        $delete = new TreeDelete();
        //$delete->filter->orEqual($delete->model->parentId, $this->dataId);
        //$delete->filter->orEqual($delete->model->childId, $this->dataId);
        $delete->filter->orEqual($delete->model->parentId, $this->getContentId());
        $delete->filter->orEqual($delete->model->childId, $this->getContentId());
        $delete->delete();

        $this->deleteSearchIndex();

    }







    protected function deleteChild()
    {

        foreach ($this->getChild() as $customRow) {

            $type = $customRow->getContentType();
            $type->deleteType();

        }

    }


    public function getText()
    {

        $text = '[No Text]';
        return $text;

    }

}