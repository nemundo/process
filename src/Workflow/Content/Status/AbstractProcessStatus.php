<?php


namespace Nemundo\Process\Workflow\Content\Status;

use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractSequenceContentType;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Group\Check\GroupRestrictionTrait;
use Nemundo\Process\Workflow\Content\Form\StatusForm;


// AbstractWorkflowStatus
abstract class AbstractProcessStatus extends AbstractSequenceContentType
{

    use ProcessStatusTrait;
    use GroupRestrictionTrait;

    /**
     * @var bool
     */
    public $toggleView = false;



    public function __construct($dataId = null)
    {
        $this->formClass = StatusForm::class;
        parent::__construct($dataId);
    }


    public function saveType()
    {

        //parent::saveType();

        $this->saveData();
        $this->saveContent();
        $this->saveTree();


        $parentProcess = $this->getParentProcess();

        if ($this->changeStatus) {
            $parentProcess->changeStatus($this);
        }

        if ($this->closeWorkflow) {
            $parentProcess->closeWorkflow();
        }


        $this->onFinished();
        $this->saveIndex();

        $this->getParentProcess()->saveIndex();

        return $this->dataId;

    }

}