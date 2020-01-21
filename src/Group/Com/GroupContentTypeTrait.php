<?php


namespace Nemundo\Process\Group\Com;


use Nemundo\Process\Group\Type\AbstractGroupContentType;

trait GroupContentTypeTrait
{

    /** @var AbstractGroupContentType[] */
    private $groupContentTypeList = [];


    public function addGroupType(AbstractGroupContentType $groupContentType)
    {

        $this->groupContentTypeList[] = $groupContentType;
        return $this;

    }

}