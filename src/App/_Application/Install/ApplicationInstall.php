<?php


namespace Nemundo\Process\App\Application\Install;


use Nemundo\Process\App\Application\Content\ApplicationContentType;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class ApplicationInstall extends AbstractInstall
{

    public function install()
    {

        (new ContentTypeSetup())
            ->addContentType(new ApplicationContentType());

        // TODO: Implement install() method.
    }

}