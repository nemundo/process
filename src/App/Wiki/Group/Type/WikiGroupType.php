<?php


namespace Nemundo\Process\App\Wiki\Group\Type;


use Nemundo\Process\Group\Type\AbstractGroupContentType;

class WikiGroupType extends AbstractGroupContentType
{

    protected function loadContentType()
    {
        $this->typeLabel = 'Wiki';
        $this->typeId = '219a65db-2469-4c52-8928-5ee57d80cfc6';
    }

}