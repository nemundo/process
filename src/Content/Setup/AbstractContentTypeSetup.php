<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentType;
use Nemundo\Process\Content\Data\ContentType\ContentTypeDelete;
use Nemundo\Process\Content\Type\AbstractContentType;

abstract class AbstractContentTypeSetup extends AbstractBase
{

    protected function addContentType(AbstractContentType $contentType)
    {

        $contentLabel = (new Translation())->getText($contentType->typeLabel);
        if ($contentLabel == null) {
            $contentLabel = $contentType->getClassNameWithoutNamespace();
        }

        $data = new ContentType();
        $data->updateOnDuplicate = true;
        $data->id = $contentType->typeId;
        $data->contentType = $contentLabel;
        $data->phpClass = $contentType->getClassName();
        $data->save();

        return $this;
    }


    public function removeContent(AbstractContentType $contentType)
    {

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->filter->andEqual($reader->model->contentTypeId, $contentType->typeId);
        foreach ($reader->getData() as $contentRow) {
            $contentType = $contentRow->getContentType();
            $contentType->deleteType();
        }

        return $this;

    }


    public function removeContentType(AbstractContentType $contentType)
    {

        $this->removeContent($contentType);
        (new ContentTypeDelete())->deleteById($contentType->typeId);

        return $this;
    }


}