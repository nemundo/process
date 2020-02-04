<?php


namespace Nemundo\Process\App\Dashboard\Setup;


use Nemundo\Process\App\Dashboard\Data\Dashboard\Dashboard;
use Nemundo\Process\Content\Setup\AbstractContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;

class DashboardSetup extends AbstractContentTypeSetup
{

    public function addDashboard(AbstractContentType $contentType) {

        $data=new Dashboard();
        $data->ignoreIfExists=true;
        $data->contentId=$contentType->getContentId();
        $data->save();


    }

}