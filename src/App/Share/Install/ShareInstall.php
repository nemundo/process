<?php


namespace Nemundo\Process\App\Share\Install;


use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Share\Content\ShareContentType;
use Nemundo\Process\App\Share\Data\ShareCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class ShareInstall extends AbstractInstall
{

    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new ShareCollection());

        (new ContentTypeSetup())
            ->addContentType(new ShareContentType());


    }

}