<?php


namespace Nemundo\Process\Workflow\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Workflow\Data\WorkflowCollection;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\Project\Install\AbstractUninstall;

class WorkflowUninstall extends AbstractUninstall
{

    public function uninstall()
    {

        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new WorkflowCollection());

    }

}