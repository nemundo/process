<?php


namespace Nemundo\Process\Process;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\AbstractContentType;
use Nemundo\Process\Data\Workflow\WorkflowReader;
use Nemundo\Process\Parameter\WorkflowParameter;
use Nemundo\Process\Site\WorkflowItemSite;
use Nemundo\Process\View\BaseView;
use Nemundo\Process\View\ProcessView;
use Nemundo\Web\View\ViewSiteTrait;
use Nemundo\Process\Status\AbstractStatus;

abstract class AbstractProcess extends AbstractContentType  // AbstractBaseClass
{

//    use ViewSiteTrait;

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
     * @var AbstractStatus
     */
    public $startStatus;

    /**
     * @var AbstractStatus[]
     */
    private $statusList = [];



    abstract protected function loadProcess();


    public function __construct()
    {

        parent::__construct();

        $this->viewClass=ProcessView::class;
        $this->baseViewClass=BaseView::class;
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

        $form= $this->startStatus->getForm($parent);
        return $form;

    }


    /**
     * @return AbstractStatus[]
     */
    public function getProcessStatusList()
    {

        $statusList = $this->getProcessNextStatus($this->startStatus, []);
        return $statusList;

    }


    private function getProcessNextStatus(AbstractStatus $status, $statusList)
    {

        $statusList[] = $status;

        $nextStatus =$status->getNextStatus();
        if ($nextStatus!==null) {
            $statusList = $this->getProcessNextStatus($nextStatus, $statusList);
        }

        return $statusList;

    }


}