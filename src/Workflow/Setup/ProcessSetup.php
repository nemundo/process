<?php


namespace Nemundo\Process\Workflow\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\App\Task\Setup\TaskSetup;
use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;


class ProcessSetup extends AbstractContentTypeSetup
{

    public function addProcess(AbstractProcess $process)
    {

        $this->addContentType($process);

        foreach ($process->getProcessStatusList() as $status) {
            $this->addContentType($status);

            foreach ($status->getMenuList() as $menuStatus) {
                $this->addContentType($menuStatus);
            }

        }

        (new TaskSetup())->addTaskType($process);

    }

}