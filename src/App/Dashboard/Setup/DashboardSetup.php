<?php


namespace Nemundo\Process\App\Dashboard\Setup;


use Nemundo\Process\App\Dashboard\Data\Dashboard\Dashboard;
use Nemundo\Process\App\Dashboard\Data\Dashboard\DashboardDelete;
use Nemundo\Process\App\Dashboard\Data\Dashboard\DashboardUpdate;
use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;

class DashboardSetup extends AbstractContentTypeSetup
{

    public function addDashboard(AbstractContentType $contentType) {

        $this->addContentType($contentType);

        $contentType->saveType();

        $data=new Dashboard();
        $data->updateOnDuplicate=true;
        $data->contentId=$contentType->getContentId();
        $data->setupStatus=true;
        $data->save();


    }


    public function resetSetupStatus() {


        $update=new DashboardUpdate();
        $update->setupStatus=false;
        $update->update();

    }

    public function removeUnused() {

        $delete = new DashboardDelete();
$delete->filter->andEqual($delete->model->setupStatus,false);
$delete->delete();

// remove user dashboard

    }


}