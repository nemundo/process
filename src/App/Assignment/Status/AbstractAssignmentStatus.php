<?php


namespace Nemundo\Process\App\Assignment\Status;


use Nemundo\Core\Base\AbstractBase;

abstract class AbstractAssignmentStatus extends AbstractBase
{

    public $id;

    public $status;

    abstract protected function loadStatus();

    public function __construct()
    {
        $this->loadStatus();
    }

}