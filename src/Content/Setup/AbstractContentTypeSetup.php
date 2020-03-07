<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentType;
use Nemundo\Process\Content\Data\ContentType\ContentTypeDelete;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Search\Data\WordContentType\WordContentTypeDelete;

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
        $data->setupStatus = true;
        $data->save();

        return $this;
    }


    public function deleteContent(AbstractContentType $contentType)
    {

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->filter->andEqual($reader->model->contentTypeId, $contentType->typeId);
        foreach ($reader->getData() as $contentRow) {
            $contentType = $contentRow->getContentType();
            $contentType->deleteType();
        }

        $delete = new ContentDelete();
        $delete->filter->andEqual($reader->model->contentTypeId, $contentType->typeId);
        $delete->delete();


        return $this;

    }


    public function removeContent(AbstractContentType $contentType)
    {

        // hier nur von content typ
        //(new ContentCheckScript())->run();


        do {

            $reader = new ContentReader();
            $reader->model->loadContentType();
            $reader->filter->andEqual($reader->model->contentTypeId, $contentType->typeId);
            $reader->limit = 1000;
            foreach ($reader->getData() as $contentRow) {
                $contentType = $contentRow->getContentType();
                $contentType->deleteType();
            }

            $count = new ContentCount();
            $count->filter->andEqual($count->model->contentTypeId, $contentType->typeId);
            $contentCount = $count->getCount();

        } while ($contentCount > 0);


        $delete = new WordContentTypeDelete();
        $delete->filter->andEqual($delete->model->contentTypeId, $contentType->typeId);
        $delete->delete();


        return $this;

    }


    public function removeContentType(AbstractContentType $contentType)
    {

        $this->removeContent($contentType);
        (new ContentTypeDelete())->deleteById($contentType->typeId);

        return $this;
    }


}