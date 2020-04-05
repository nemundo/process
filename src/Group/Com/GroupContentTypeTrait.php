<?php


namespace Nemundo\Process\Group\Com;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Group\Type\AbstractGroupContentType;

trait GroupContentTypeTrait
{

    /** @var AbstractGroupContentType[] */
    private $groupContentTypeList = [];


    //public function addGroupType(AbstractGroupContentType $groupContentType)
     public function addGroupType(AbstractContentType $groupContentType)
    {

        $this->groupContentTypeList[] = $groupContentType;
        return $this;

    }

}