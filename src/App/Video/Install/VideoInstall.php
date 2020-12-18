<?php

namespace Nemundo\Process\App\Video\Install;

use Nemundo\App\Application\Setup\ApplicationSetup;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Video\Application\VideoApplication;
use Nemundo\Process\App\Video\Content\Vimeo\VimeoContentType;
use Nemundo\Process\App\Video\Content\YouTube\YouTubeContentType;
use Nemundo\Process\App\Video\Data\VideoCollection;
use Nemundo\Process\Cms\Setup\CmsSetup;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class VideoInstall extends AbstractInstall
{

    public function install()
    {

        (new ApplicationSetup())
            ->addApplication(new VideoApplication());

        (new ModelCollectionSetup())
            ->addCollection(new VideoCollection());

        (new ContentTypeSetup())
            ->addContentType(new YouTubeContentType());

        /*(new CmsSetup(new VideoApplication()))
            ->addContentType(new YouTubeContentType())
            ->addContentType(new VimeoContentType());*/


    }
}