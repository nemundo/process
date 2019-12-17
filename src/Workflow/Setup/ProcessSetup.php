<?php


namespace Nemundo\Process\Workflow\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractStatus;
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

    private function addStatus(AbstractStatus $status)
    {

        $setup = new StatusSetup();
        $setup->addStatus($status);

    }

}