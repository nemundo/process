<?php


namespace Nemundo\Process\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Inbox\Data\InboxCollection;
use Nemundo\Process\App\News\Data\NewsCollection;
use Nemundo\Process\App\Wiki\Data\WikiCollection;
use Nemundo\Process\Content\Data\ContentCollection;
use Nemundo\Process\Data\ProcessCollection;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Project\Install\AbstractUninstall;

class ProcessUninstall extends AbstractUninstall
{

    public function uninstall()
    {

        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new ProcessCollection());
        $setup->removeCollection(new TemplateCollection());
        $setup->removeCollection(new ContentCollection());
        $setup->removeCollection(new NewsCollection());
        $setup->removeCollection(new InboxCollection());
        $setup->removeCollection(new WikiCollection());

    }

}