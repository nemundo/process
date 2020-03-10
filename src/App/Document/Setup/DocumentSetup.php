<?php


namespace Nemundo\Process\App\Document\Setup;


use Nemundo\Process\App\Document\Data\DocumentType\DocumentType;
use Nemundo\Process\App\Document\Data\DocumentType\DocumentTypeDelete;
use Nemundo\Process\App\Document\Data\DocumentType\DocumentTypeUpdate;
use Nemundo\Process\Content\Data\ContentType\ContentTypeDelete;
use Nemundo\Process\Content\Data\ContentType\ContentTypeUpdate;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractType;


class DocumentSetup extends ContentTypeSetup
{


    public function addDocumentType() {

    }

    //public function addContentType(AbstractContentType $contentType)
     public function addContentType(AbstractType $contentType)
    {

        parent::addContentType($contentType);

        $data = new DocumentType();
        $data->updateOnDuplicate = true;
        $data->contentTypeId = $contentType->typeId;
        $data->setupStatus=true;
        $data->save();

        return $this;

    }



    public function resetSetupStatus()
    {

        $update = new DocumentTypeUpdate();
        $update->setupStatus = false;
        $update->update();

    }


    public function deleteUnusedSetupStatus()
    {

        $delete = new DocumentTypeDelete();
        $delete->filter->andEqual($delete->model->setupStatus, false);
        $delete->delete();

    }

}