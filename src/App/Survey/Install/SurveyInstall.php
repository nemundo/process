<?php


namespace Nemundo\Process\App\Survey\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;

use Nemundo\Process\App\Survey\Content\Survey\SurveyContentType;
use Nemundo\Process\App\Survey\Data\SurveyCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class SurveyInstall extends AbstractInstall
{

    public function install()
    {

        $setup=new ModelCollectionSetup();
        $setup->addCollection(new SurveyCollection());

        $setup=new ContentTypeSetup();
        $setup->addContentType(new SurveyContentType());


    }

}