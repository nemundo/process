<?php


namespace Nemundo\Process\Install;

use Nemundo\App\Script\Setup\ScriptSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Install\AssignmentInstall;
use Nemundo\Process\App\Bookmark\Install\BookmarkInstall;
use Nemundo\Process\App\Calendar\Install\CalendarInstall;
use Nemundo\Process\App\Document\Data\DocumentCollection;
use Nemundo\Process\App\Favorite\Install\FavoriteInstall;
use Nemundo\Process\App\Notification\Install\NotificationInstall;
use Nemundo\Process\App\Share\Install\ShareInstall;
use Nemundo\Process\App\Task\Install\TaskInstall;
use Nemundo\Process\App\WebLog\Content\WebLogContentType;
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
use Nemundo\App\Application\Type\Install\AbstractInstall;


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
        //(new ContainerInstall())->install();

        //(new RelationInstall())->install();


        (new TemplateInstall())->install();
        (new FavoriteInstall())->install();
        (new ShareInstall())->install();
        (new BookmarkInstall())->install();

        $setup = new ContentTypeSetup();
        $setup->addContentType(new WebLogContentType());

        $setup = new ScriptSetup();
        $setup->addScript(new ProcessCleanScript());
        $setup->addScript(new ProcessTestScript());

    }

}