<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\ContentType\ContentType;
use Nemundo\Process\Content\Data\ContentType\ContentTypeDelete;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;

class ContentTypeSetup extends AbstractBase
{

    public function addContentType(AbstractContentType $contentType)
    {

        $contentLabel = (new Translation())->getText($contentType->contentLabel);
        if ($contentLabel == null) {
            $contentLabel = $contentType->getClassNameWithoutNamespace();
        }

        $data = new ContentType();
        $data->updateOnDuplicate = true;
        $data->id = $contentType->contentId;
        $data->contentType = $contentLabel;
        $data->phpClass = $contentType->getClassName();
        $data->save();

        return $this;
    }


    public function removeContentType(AbstractContentType $contentType)
    {


        // tree delete


        $delete = new ContentDelete();
        $delete->filter->andEqual($delete->model->contentTypeId, $contentType->contentId);
        $delete->delete();

        (new ContentTypeDelete())->deleteById($contentType->contentId);

       /*
        $delete = new SearchIndexDelete();
        //$delete->model->loadContent();
        $delete->filter->andEqual($delete->model->content->contentTypeId,  $contentType->contentId);
        $delete->delete();*/


        // delete content
        return $this;
    }


}