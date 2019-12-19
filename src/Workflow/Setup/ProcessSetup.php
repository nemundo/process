<?php


namespace Nemundo\Process\Workflow\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Workflow\Data\Process\Process;


class ProcessSetup extends AbstractBase
{

    public function addProcess(AbstractProcess $process)
    {

        $setup = new ContentTypeSetup();
        $setup->addContentType($process);


        $data = new Process();
        $data->updateOnDuplicate = true;
        $data->process = $process->process;
        $data->contentTypeId = $process->id;
        $data->save();


        foreach ($process->getProcessStatusList() as $status) {
            $this->addStatus($status);

            foreach ($status->getMenuStatus() as $menuStatus) {
                $this->addStatus($menuStatus);
            }

        }


    }

    //private function addStatus(AbstractStatus $status)
     private function addStatus(AbstractContentType $status)
    {

        $setup = new StatusSetup();
        $setup->addStatus($status);

    }

}