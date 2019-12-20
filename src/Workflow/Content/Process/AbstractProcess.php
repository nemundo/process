<?php


namespace Nemundo\Process\Workflow\Content\Process;


use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Parameter\WorkflowParameter;
use Nemundo\Process\Workflow\Com\Container\BaseWorkflowContainer;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Content\View\ProcessView;
use Nemundo\Process\Workflow\Data\Workflow\WorkflowReader;
use Nemundo\Process\Workflow\Site\WorkflowItemSite;


abstract class AbstractProcess extends AbstractContentType
{

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $process;

    /**
     * @var string
     */
    public $prefixNumber;

    /**
     * @var int
     */
    public $startNumber;

    /**
     * @var string
     */
    public $baseViewClass;

    // processView

    // pageView


    /**
     * @var AbstractProcessStatus
     */
    public $startStatus;

    /**
     * @var AbstractProcessStatus[]
     */
    private $statusList = [];


    abstract protected function loadProcess();


    public function __construct()
    {

        parent::__construct();

        $this->viewClass = ProcessView::class;
        $this->baseViewClass = BaseWorkflowContainer::class;
        $this->viewSite = WorkflowItemSite::$site;
        $this->parameterClass = WorkflowParameter::class;

        $this->loadProcess();

    }

    protected function loadContentType()
    {
        // TODO: Implement loadContentType() method.
    }


    public function getSubject($dataId)
    {

        $workflowRow = (new WorkflowReader())->getRowById($dataId);
        $subject = $workflowRow->getSubject();
        return $subject;

    }


    public function getForm(AbstractHtmlContainer $parent)
    {

        $form = $this->startStatus->getForm($parent);
        return $form;

    }


    /**
     * @return AbstractProcessStatus[]
     */
    public function getProcessStatusList()
    {

        $statusList = $this->getProcessNextStatus($this->startStatus, []);
        return $statusList;

    }


    private function getProcessNextStatus(AbstractProcessStatus $status, $statusList)
    {

        $statusList[] = $status;

        $nextStatus = $status->getNextStatus();
        if ($nextStatus !== null) {
            $statusList = $this->getProcessNextStatus($nextStatus, $statusList);
        }

        return $statusList;

    }


}