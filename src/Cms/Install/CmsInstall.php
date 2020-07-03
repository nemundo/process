<?php

namespace Nemundo\Process\Cms\Install;

use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Video\Content\YouTube\YouTubeContentType;
use Nemundo\Process\App\Wiki\Content\WikiPageContentType;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Cms\Data\CmsCollection;
use Nemundo\Process\Cms\Setup\CmsSetup;
use Nemundo\Process\Cms\Type\TextCmsType;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class CmsInstall extends AbstractInstall
{


    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new CmsCollection());

        /*
        $setup=new CmsSetup();
        $setup->parentContentType=new WikiPageContentType();
        $setup->addContentType(new YouTubeContentType());*/



        /*
        (new ContentTypeSetup())
            ->addContentType(new TextCmsType());

        (new WikiSetup())
            ->addContentType(new TextCmsType());*/

    }
}