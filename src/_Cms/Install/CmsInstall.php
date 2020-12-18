<?php

namespace Nemundo\Process\Cms\Install;

use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\Cms\Data\CmsCollection;
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


        /*
        (new CmsSetup(new XcontestApplication()))
        ->addContentType(new UniqueIdContentType())
            ->addContentType(new VideoContentType());*/


    }
}