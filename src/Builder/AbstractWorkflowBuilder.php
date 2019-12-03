<?php


namespace Nemundo\Process\Builder;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Process\AbstractProcess;

abstract class AbstractWorkflowBuilder extends AbstractBase
{

    /**
     * @var AbstractProcess
     */
    protected $process;

    abstract protected function loadWorkflow();

    abstract public function createWorkflow();

    public function __construct()
    {
        $this->loadWorkflow();
    }


}