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


    protected function onFinished()
    {

    }


    public function deleteType()
    {

        parent::deleteType();
        $this->deleteTree();

    }


    public function getText()
    {

        $text = '';
        return $text;

    }


    public function setActive()
    {
        $this->onActive();
        $this->saveIndex();
    }


    public function setInactive()
    {
        $this->onInactive();
        $this->saveIndex();
    }


    protected function onActive()
    {

    }

    protected function onInactive()
    {

    }

    protected function isActive()
    {
        return true;
    }


}