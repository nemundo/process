<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\ContentType\ContentType;
use Nemundo\Process\Content\Data\ContentType\ContentTypeDelete;
use Nemundo\Process\Content\Data\ContentType\ContentTypeUpdate;
use Nemundo\Process\Content\Type\AbstractContentType;

class ContentTypeSetup extends AbstractContentTypeSetup
{

    public function addContentType(AbstractContentType $contentType)
    {
         parent::addContentType($contentType);
        return $this;
    }


    public function resetSetupStatus() {

        $update = new ContentTypeUpdate();
        $update->setupStatus=false;
        $update->update();

    }


    public function deleteSetupStatus() {

        $delete = new ContentTypeDelete();
        $delete->filter->andEqual($delete->model->setupStatus, false);
        $delete->delete();

    }

}