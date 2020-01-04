<?php


namespace Nemundo\Process\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Favorite\Data\FavoriteCollection;
use Nemundo\Process\App\Inbox\Install\InboxUninstall;
use Nemundo\Process\App\Wiki\Install\WikiUninstall;
use Nemundo\Process\Content\Install\ContentUninstall;
use Nemundo\Process\Geo\Data\GeoCollection;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Process\Workflow\Install\WorkflowUninstall;
use Nemundo\Project\Install\AbstractUninstall;
use Nemundo\ToDo\Install\ToDoUninstall;


class ProcessUninstall extends AbstractUninstall
{

    public function uninstall()
    {


        (new ContentUninstall())->uninstall();
        (new WorkflowUninstall())->uninstall();
        (new InboxUninstall())->uninstall();
        (new WikiUninstall())->uninstall();

        //(new ChangeRequestUninstall())->uninstall();
        (new ToDoUninstall())->uninstall();

        $setup=new ModelCollectionSetup();
        $setup->removeCollection(new SearchCollection());
        $setup->removeCollection(new FavoriteCollection());
        $setup->removeCollection(new GroupCollection());
        $setup->removeCollection(new GeoCollection());

    }

}