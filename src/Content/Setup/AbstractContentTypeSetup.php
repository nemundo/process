<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentDelete;
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


        $delete = new ContentDelete();
        $delete->filter->andEqual($delete->model->contentTypeId, $contentType->typeId);
        $delete->delete();

        // tree delete

    }


    public function removeContentType(AbstractContentType $contentType)
    {

        $this->removeContent($contentType);

        (new ContentTypeDelete())->deleteById($contentType->typeId);

        /*
         $delete = new SearchIndexDelete();
         //$delete->model->loadContent();
         $delete->filter->andEqual($delete->model->content->contentTypeId,  $contentType->contentId);
         $delete->delete();*/


        // delete content
        return $this;
    }


}