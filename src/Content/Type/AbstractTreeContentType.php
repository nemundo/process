<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Log\LogMessage;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Search\Type\SearchIndexTrait;
use Nemundo\Process\Tree\Type\TreeTypeTrait;


abstract class AbstractTreeContentType extends AbstractContentType
{

    //use ContentTreeTrait;
    use TreeTypeTrait;
    use SearchIndexTrait;

    /**
     * @var string
     */
   // public $parentId;

    /**
     * @var bool
     */
    public $toggleView = false;
    // --> falscher Ort !!!


    public function saveType()
    {

        parent::saveType();

        /*
        if ($this->existItem()) {
            $this->createMode = false;
        }*/

        //$this->saveContent();
        $this->saveTree();

        //$this->onFinished();
        //$this->saveIndex();

    }

/*
    protected function saveTree()
    {

        if ($this->parentId !== null) {
            $writer = new TreeWriter();
            $writer->parentId = $this->parentId;
            $writer->dataId = $this->contentId;
            $writer->write();
        }

    }*/


    protected function onFinished()
    {

    }




   /* protected function onIndex()
    {

    }*/


    public function saveIndex()
    {

        //$this->onDataRow();
        //$this->onIndex();

        parent::saveIndex();

        //$this->saveContentIndex();
        //$this->saveSearchIndex();

    }



    public function deleteType()
    {

        parent::deleteType();

        $this->deleteTree();

        /*
        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->getContentId());
        $delete->filter->orEqual($delete->model->childId, $this->getContentId());
        $delete->delete();*/

        //$this->deleteSearchIndex();

    }


    /*
    protected function deleteChild()
    {

        foreach ($this->getChild() as $customRow) {

            $type = $customRow->getContentType();
            $type->deleteType();

        }

    }*/


    public function getText()
    {

        $text = '';
        return $text;

    }



    // JsonExportTrait
    public function exportJson()
    {

        $data['id'] = $this->dataId;
        $data['subject'] = $this->getSubject();

        return $data;


    }


    public function setActive()
    {
        $this->onActive();
    }


    public function setInactive()
    {
        $this->onInactive();
    }


    protected function onActive()
    {

    }

    protected function onInactive()
    {

    }


    public function getForm(AbstractHtmlContainer $parent)
    {

        if ($this->formClass == null) {
            (new LogMessage())->writeError('No Form' . $this->getClassName());
        }

        /** @var AbstractContentForm $form */
        $form = new $this->formClass($parent);

        if (!$this->createMode) {
            $form->dataId = $this->dataId;
        }
        $form->contentType = $this;
        $form->parentId = $this->parentId;
        $form->createMode = $this->createMode;


        return $form;

    }


}