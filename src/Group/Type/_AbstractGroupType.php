<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Core\Base\AbstractBase;

abstract class AbstractGroupType extends AbstractBase
{

    public $id;

    public $groupType;

    abstract protected function loadGroupType();

    public function __construct()
    {
        $this->loadGroupType();
    }

}