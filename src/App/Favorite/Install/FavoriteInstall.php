<?php

namespace Nemundo\Process\App\Favorite\Install;

use Nemundo\App\Script\Type\AbstractScript;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Favorite\Content\FavoriteContentType;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Install\AbstractInstall;
use Nemundo\Process\App\Favorite\Data\FavoriteCollection;

class FavoriteInstall extends AbstractInstall
{
    public function install()
    {


        $setup = new ModelCollectionSetup();
        $setup->addCollection(new FavoriteCollection());

$setup=new ContentTypeSetup();
$setup->addContentType(new FavoriteContentType());

    }
}