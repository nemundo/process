<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Process\Content\Collection\AbstractContentTypeCollection;
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


    public function addContentTypeCollection(AbstractContentTypeCollection $collection)
    {

        foreach ($collection->getContentTypeList() as $contentType) {
            $this->addContentType($contentType);
        }

        return $this;

    }


    public function resetSetupStatus()
    {

        $update = new ContentTypeUpdate();
        $update->setupStatus = false;
        $update->update();

    }


    public function deleteSetupStatus()
    {

        $delete = new ContentTypeDelete();
        $delete->filter->andEqual($delete->model->setupStatus, false);
        $delete->delete();

    }

}