<?php


namespace Nemundo\Process\Group\Finder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Group\Data\Group\GroupReader;

class GroupFinder extends AbstractBase
{

    private $groupId;

    public function __construct($groupId)
    {
        $this->groupId=$groupId;
    }



   public function getGroupType()
   {


       $reader = new GroupReader();
       //$reader->model->loadGroupType();
       $reader->model->loadContent();
       $reader->model->content->loadContentType();
       $row = $reader->getRowById($this->groupId);
       //$groupType = $row->groupType->getContentType();
       $groupType = $row->content->getContentType();

       return $groupType;

   }





}