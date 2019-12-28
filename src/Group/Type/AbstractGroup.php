<?php


namespace Nemundo\Process\Group\Type;


use Nemundo\Core\Base\AbstractBase;

abstract class AbstractGroup extends AbstractBase
{

    public $id;

    public $group;

    abstract protected function loadGroup();

    public function __construct()
    {
        $this->loadGroup();
    }


}