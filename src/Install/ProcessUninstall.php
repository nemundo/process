<?php


namespace Nemundo\Process\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Assignment\Install\AssignmentUninstall;
use Nemundo\Process\App\Document\Data\DocumentCollection;
use Nemundo\Process\App\Favorite\Data\FavoriteCollection;
use Nemundo\Process\App\Inbox\Install\InboxUninstall;
use Nemundo\Process\App\Wiki\Install\WikiUninstall;
use Nemundo\Process\Content\Install\ContentUninstall;
use Nemundo\Process\Geo\Data\GeoCollection;
use Nemundo\Process\Group\Data\GroupCollection;
use Nemundo\Process\Search\Data\SearchCollection;
use Nemundo\Project\Install\AbstractUninstall;


class ProcessUninstall extends AbstractUninstall
{

    public function uninstall()
    {


        (new ContentUninstall())->uninstall();
        (new InboxUninstall())->uninstall();
        (new WikiUninstall())->uninstall();
        (new AssignmentUninstall())->uninstall();

        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new SearchCollection());
        $setup->removeCollection(new FavoriteCollection());
        $setup->removeCollection(new GroupCollection());
        $setup->removeCollection(new GeoCollection());
        $setup->removeCollection(new DocumentCollection());

    }

}