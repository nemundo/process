<?php

namespace Nemundo\Process\App\Video\Install;

use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Video\Content\YouTube\YouTubeContentType;
use Nemundo\Process\App\Video\Data\VideoCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class VideoInstall extends AbstractInstall
{

    public function install()
    {


        (new ModelCollectionSetup())
            ->addCollection(new VideoCollection());

        (new ContentTypeSetup())
            ->addContentType(new YouTubeContentType());


    }
}