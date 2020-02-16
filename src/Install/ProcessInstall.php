<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Install\AssignmentInstall;
use Nemundo\Process\App\Dashboard\Install\DashboardInstall;
use Nemundo\Process\App\Dashboard\Setup\DashboardSetup;
use Nemundo\Process\App\Document\Data\DocumentCollection;
use Nemundo\Process\App\Favorite\Install\FavoriteInstall;
use Nemundo\Process\App\Message\Install\MessageInstall;
use Nemundo\Process\App\Notification\Install\NotificationInstall;
use Nemundo\Process\App\Survey\Install\SurveyInstall;
use Nemundo\Process\App\WebLog\Content\WebLogContentType;
use Nemundo\Process\App\Wiki\Install\WikiInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Geo\Install\GeoInstall;
use Nemundo\Process\Group\Install\GroupInstall;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Script\ProcessTestScript;
use Nemundo\Process\Search\Install\SearchInstall;
use Nemundo\Process\Template\Install\TemplateInstall;
use Nemundo\Process\Widget\UniqueId\UniqueIdContentType;
use Nemundo\Project\Install\AbstractInstall;

class ProcessInstall extends AbstractInstall
{

    public function install()
    {


        (new ContentInstall())->install();
        (new SearchInstall())->install();
        //(new WorkflowInstall())->install();

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new DocumentCollection());

        (new WikiInstall())->install();
        (new TemplateInstall())->install();
        (new FavoriteInstall())->install();
        (new GroupInstall())->install();
        (new AssignmentInstall())->install();
        (new NotificationInstall())->install();
        (new MessageInstall())->install();
        (new DashboardInstall())->install();
        (new GeoInstall())->install();
        (new SurveyInstall())->install();

        $setup = new ContentTypeSetup();
        $setup->addContentType(new WebLogContentType());


        /*
                $setup = new ModelCollectionSetup();
                //$setup->addCollection(new SearchCollection());
                //$setup->addCollection(new GroupCollection());
                $setup->addCollection(new GeoCollection());
                $setup->addCollection(new SurveyCollection());
                $setup->addCollection(new NewsCollection());
                $setup->addCollection(new CalendarCollection());
                //$setup->addCollection(new DocumentCollection());
                $setup->addCollection(new PlzCollection());*/

        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());
        $setup->addScript(new ProcessTestScript());
        //$setup->addScript(new ProcessReInstallScript());


        //$setup = new DashboardSetup();
        //$setup->addDashboard(new UniqueIdContentType());


    }

}