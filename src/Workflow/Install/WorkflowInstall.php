<?php


namespace Nemundo\Process\Workflow\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Workflow\Data\WorkflowCollection;
use Nemundo\Project\Install\AbstractInstall;

class WorkflowInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new WorkflowCollection());

    }

}