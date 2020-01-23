<?php


namespace Nemundo\Process\Workflow\Content\View;


use Nemundo\Com\FormBuilder\RedirectTrait;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;


// AbstractWorkflowView
abstract class AbstractProcessViewold extends AbstractContentView
{

    use RedirectTrait;

    /**
     * @var AbstractProcess
     */
    public $contentType;


    public $appendWorkflowParameter = false;

    //public $showDocument = true;


}