<?php


namespace Nemundo\Process\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Data\Process\Process;
use Nemundo\Process\Data\Status\Status;
use Nemundo\Process\Process\AbstractProcess;
use Nemundo\Process\Status\AbstractStatus;

class ProcessSetup extends AbstractBase
{

    public function addProcess(AbstractProcess $process) {

        $data = new Process();
        $data->updateOnDuplicate = true;
        $data->id = $process->id;
        $data->process = $process->process;
        $data->save();


        foreach ($process->getProcessStatusList() as $status) {
            $this->addStatus($status);

            foreach ($status->getMenuStatus() as $menuStatus) {
                $this->addStatus($menuStatus);
            }

        }

        /*
        foreach ($process->getSubStatusList() as $status) {
            $this->addStatus($status);
        }*/

    }

    private function addStatus(AbstractStatus $status)
    {


        $data = new Status();
        $data->updateOnDuplicate = true;
        $data->id = $status->id;
        $data->statusLabel = $status->label;
        $data->statusClass = $status->getClassName();
        $data->save();



    }

}