<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Process\Content\Type\AbstractTreeContentType;


// braucht es das???
// ja z.B. IssuetTrackerGroupType
abstract class AbstractGroupContentType extends AbstractTreeContentType
{

    use GroupIndexTrait;


    protected $group;


    public function __construct($dataId = null)
    {

        parent::__construct($dataId);
        $this->loadGroup();

    }

    protected function loadGroup()
    {

    }


    protected function onIndex()
    {

        parent::onIndex();
        $this->saveGroupIndex();

    }


    protected function onDelete()
    {

        parent::onDelete();
        $this->deleteGroupIndex();

    }


    protected function getGroupLabel()
    {

        return $this->group;

    }

}