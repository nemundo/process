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

    use TreeTypeTrait;
    use SearchIndexTrait;

    public function saveType()
    {

        //parent::saveType();

        $this->saveData();
        $this->saveContent();
        $this->saveTree();
        $this->onFinished();
        $this->saveIndex();

    }



    // afterContentSave
    protected function onFinished()
    {

    }


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

        //$this->deleteSearchIndex();

    }


    public function getText()
    {

        $text = '';
        return $text;

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

}