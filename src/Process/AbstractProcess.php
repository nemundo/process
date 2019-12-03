<?php


namespace Nemundo\Process\Process;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Base\AbstractBaseClass;
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


    public $prefixNumber;

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

    /**
     * @var AbstractStatus[]
     */
   // private $subStatusList = [];


    abstract protected function loadProcess();


    public function __construct()
    {
        $this->loadProcess();
    }


    /*
    protected function addStatus(AbstractStatus $status) {
        $this->statusList[]=$status;
    }*/


   /* protected function addSubStatus(AbstractStatus $status)
    {
        $this->subStatusList[] = $status;
    }



    /*
    public function getNextStatus(AbstractStatus $status) {

        $currentNumber=null;
        $number=0;
        foreach ($this->statusList as $value) {

            if ($value->id == $status->id) {
                $currentNumber =$number;
            }
            $number++;
        }

        $nextNumber = $currentNumber+1;

        $nextStatus=null;
        if (isset($this->statusList[$nextNumber])) {
            $nextStatus=$this->statusList[$nextNumber];
        }

        return $nextStatus;

    }*/


    /*
    public function getNextStatusById($statusId) {

        $currentNumber=null;
        $number=0;
        foreach ($this->statusList as $status) {

            if ($status->id == $statusId) {
                $currentNumber =$number;
            }
            $number++;
        }

        $nextNumber = $currentNumber+1;

        $nextStatus=null;
        if (isset($this->statusList[$nextNumber])) {
            $nextStatus=$this->statusList[$nextNumber];
        }

        return $nextStatus;

    }*/


    /*
    public function getStatusList() {

        return $this->statusList;

    }*/

    /*public function getSubStatusList()
    {

        return $this->subStatusList;

    }*/


    /**
     * @return AbstractStatus[]
     */
    public function getProcessStatusList()
    {

        //$statusList=[];

        $statusList = $this->getProcessNextStatus($this->startStatus, []);
        return $statusList;

    }


    private function getProcessNextStatus(AbstractStatus $status, $statusList)
    {

        //(new Debug())->write($statusList);
        $statusList[] = $status;

        $nextStatus = $status->nextStatus;
        if ($nextStatus !== null) {
            $statusList = $this->getProcessNextStatus($nextStatus, $statusList);
        }

        return $statusList;

    }


}