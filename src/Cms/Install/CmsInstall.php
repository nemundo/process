<?php

namespace Nemundo\Process\Cms\Install;

use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Wiki\Setup\WikiSetup;
use Nemundo\Process\Cms\Data\CmsCollection;
use Nemundo\Process\Cms\Type\TextCmsType;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;

class CmsInstall extends AbstractInstall
{


    public function install()
    {

        (new ModelCollectionSetup())
            ->addCollection(new CmsCollection());

        (new ContentTypeSetup())
            ->addContentType(new TextCmsType());

        (new WikiSetup())
            ->addContentType(new TextCmsType());

    }
}