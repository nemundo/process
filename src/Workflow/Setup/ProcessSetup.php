<?php


namespace Nemundo\Process\Workflow\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Content\Process\AbstractProcess;
use Nemundo\Process\Workflow\Data\Process\Process;


class ProcessSetup extends AbstractContentTypeSetup  // AbstractBase
{

    public function addProcess(AbstractProcess $process)
    {

        $this->addContentType($process);

        //$setup = new ContentTypeSetup();
        //$setup->addContentType($process);

        $data = new Process();
        $data->ignoreIfExists = true;
        $data->contentTypeId = $process->typeId;
        $data->save();


        foreach ($process->getProcessStatusList() as $status) {
            $this->addContentType($status);

            foreach ($status->getMenuList() as $menuStatus) {
                $this->addContentType($menuStatus);
            }

        }


    }


    /*
    private function addStatus(AbstractContentType $status)
    {

        $setup = new ContentTypeSetup();
        $setup->addContentType($status);

    }*/

}