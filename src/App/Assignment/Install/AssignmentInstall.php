<?php


namespace Nemundo\Process\App\Assignment\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Content\Group\AssignmentContentType;
use Nemundo\Process\App\Assignment\Content\Message\MessageAssignmentContentType;
use Nemundo\Process\App\Assignment\Content\ReAssignment\ReAssignmentContentType;
use Nemundo\Process\App\Assignment\Data\AssignmentCollection;
use Nemundo\Process\App\Assignment\Data\AssignmentStatus\AssignmentStatus;
use Nemundo\Process\App\Assignment\Status\AbstractAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\CancelAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\ClosedAssignmentStatus;
use Nemundo\Process\App\Assignment\Status\OpenAssignmentStatus;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class AssignmentInstall extends AbstractInstall
{

    public function install()
    {

        $setup=new ModelCollectionSetup();
        $setup->addCollection(new AssignmentCollection());

        $setup=new ContentTypeSetup();
        $setup->addContentType(new AssignmentContentType());
        $setup->addContentType(new MessageAssignmentContentType());
        $setup->addContentType(new ReAssignmentContentType());

        $this->addStatus(new OpenAssignmentStatus());
        $this->addStatus(new ClosedAssignmentStatus());
        $this->addStatus(new CancelAssignmentStatus());

        // TODO: Implement install() method.
    }


    private function addStatus(AbstractAssignmentStatus $status) {

        $data=new AssignmentStatus();
        $data->updateOnDuplicate=true;
        $data->id=$status->id;
        $data->status=$status->status;
        $data->save();

    }

}