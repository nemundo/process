<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Process\Search\Type\SearchIndexTrait;
use Nemundo\Process\Tree\Type\TreeTypeTrait;


abstract class AbstractTreeContentType extends AbstractContentType
{

    use TreeTypeTrait;
    use SearchIndexTrait;

    public function saveType()
    {

        $this->saveData();
        $this->saveContent();
        $this->saveTree();
        $this->onFinished();
        $this->saveIndex();

        $this->saveContentIndex();

    }


    // afterContentSave
    protected function onFinished()
    {

    }


    /*
    public function saveIndex()
    {

        //$this->onDataRow();
        //$this->onIndex();

        parent::saveIndex();

        //$this->saveContentIndex();
        //$this->saveSearchIndex();

    }*/


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