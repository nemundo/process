<?php


namespace Nemundo\Process\Process;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Process\View\BaseView;
use Nemundo\Web\View\ViewSiteTrait;
use Nemundo\Process\Status\AbstractStatus;

abstract class AbstractProcess extends AbstractBaseClass
{

    use ViewSiteTrait;

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

        $this->baseViewClass=BaseView::class;
        $this->loadProcess();
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