<?php


namespace Nemundo\Process\App\Assignment\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Content\Group\AssignmentContentType;
use Nemundo\Process\App\Assignment\Content\Message\MessageAssignmentContentType;
use Nemundo\Process\App\Assignment\Data\AssignmentCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractUninstall;

class AssignmentUninstall extends AbstractUninstall
{

    public function uninstall()
    {

        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new AssignmentCollection());

        $setup=new ContentTypeSetup();
        $setup->removeContentType(new AssignmentContentType());
        $setup->removeContentType(new MessageAssignmentContentType());

        // TODO: Implement uninstall() method.
    }

}