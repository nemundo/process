<?php


namespace Nemundo\Process\App\Wiki\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\App\Wiki\Data\WikiType\WikiType;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;

class WikiSetup extends ContentTypeSetup
{

    public function addContentType(AbstractContentType $contentType) {

        parent::addContentType($contentType);

        $data=new WikiType();
        $data->updateOnDuplicate=true;
        $data->contentTypeId=$contentType->typeId;
        $data->save();

        return $this;


    }

}