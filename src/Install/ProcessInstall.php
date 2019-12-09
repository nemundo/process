<?php


namespace Nemundo\Process\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Data\ProcessCollection;
use Nemundo\Process\Setup\StatusSetup;
use Nemundo\Process\Template\Data\TemplateCollection;
use Nemundo\Process\Template\Status\DocumentDeleteStatus;
use Nemundo\Process\Template\Status\ReopenStatus;
use Nemundo\Project\Install\AbstractInstall;

class ProcessInstall extends AbstractInstall
{

    public function install()
    {

        $setup = new ModelCollectionSetup();
        $setup->addCollection(new ProcessCollection());
        $setup->addCollection(new TemplateCollection());

        $setup=new StatusSetup();
        $setup->addStatus(new DocumentDeleteStatus());
        $setup->addStatus(new ReopenStatus());


    }

}