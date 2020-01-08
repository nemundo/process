<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Writer\TreeContentWriter;


abstract class AbstractTreeContentType extends AbstractContentType
{

    use ContentTreeTrait;

    /**
     * @var string
     */
    public $parentId;


    public function saveType()
    {

        if ($this->createMode) {
            $this->onCreate();
        } else {
            $this->onUpdate();
        }

        $writer = new TreeContentWriter();
        $writer->contentType = $this;
        $writer->parentId = $this->parentId;
        $writer->dataId = $this->dataId;
        $writer->subject = $this->getSubject();
        $writer->write();

        $this->saveSearchIndex();

        return $this->dataId;

    }


    public function deleteType()
    {

        parent::deleteType();

        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->dataId);
        $delete->filter->orEqual($delete->model->childId, $this->dataId);
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