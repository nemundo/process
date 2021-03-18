<?php


namespace Nemundo\Process\App\Assignment\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Content\AssignmentProcessStatus;
use Nemundo\Process\App\Assignment\Data\AssignmentCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\App\Application\Type\Install\AbstractInstall;


class AssignmentInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new AssignmentCollection());

        (new ContentTypeSetup())
            ->addContentType(new AssignmentProcessStatus());


    }

}