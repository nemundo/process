<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Application\Content\ApplicationContentType;
use Nemundo\Process\App\Application\Install\ApplicationInstall;
use Nemundo\Process\App\Assignment\Install\AssignmentInstall;
use Nemundo\Process\App\Bookmark\Install\BookmarkInstall;
use Nemundo\Process\App\Calendar\Install\CalendarInstall;
use Nemundo\Process\App\Dashboard\Install\DashboardInstall;
use Nemundo\Process\App\Document\Data\DocumentCollection;
use Nemundo\Process\App\Favorite\Install\FavoriteInstall;
use Nemundo\Process\App\Notification\Install\NotificationInstall;
use Nemundo\Process\App\Share\Install\ShareInstall;
use Nemundo\Process\App\Task\Install\TaskInstall;
use Nemundo\Process\App\WebLog\Content\WebLogContentType;
use Nemundo\Process\App\Wiki\Install\WikiInstall;
use Nemundo\Process\Content\Install\ContentInstall;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Geo\Install\GeoInstall;
use Nemundo\Process\Group\Install\GroupInstall;
use Nemundo\Process\Index\Install\IndexInstall;
use Nemundo\Process\Relation\Install\RelationInstall;
use Nemundo\Process\Script\ProcessCleanScript;
use Nemundo\Process\Script\ProcessTestScript;
use Nemundo\Process\Search\Install\SearchInstall;
use Nemundo\Process\Template\Install\TemplateInstall;
use Nemundo\Project\Install\AbstractInstall;


class ProcessInstall extends AbstractInstall
{

    public function install()
    {


        (new ContentInstall())->install();
        (new SearchInstall())->install();
        //(new WorkflowInstall())->install();
        (new GroupInstall())->install();

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new DocumentCollection());

        (new TaskInstall())->install();
        (new CalendarInstall())->install();
        (new AssignmentInstall())->install();
        (new NotificationInstall())->install();
        (new IndexInstall())->install();

        (new RelationInstall())->install();

        //(new WikiInstall())->install();

        (new ApplicationInstall())->install();

        (new TemplateInstall())->install();
        (new FavoriteInstall())->install();
        (new ShareInstall())->install();
        (new BookmarkInstall())->install();

        //(new MessageInstall())->install();
        (new DashboardInstall())->install();
        (new GeoInstall())->install();
        //(new SurveyInstall())->install();

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


        (new ContentTypeSetup())
            ->addContentType(new ApplicationContentType());

        //(new NewsAppContentType())
        //    ->saveType();


    }

}