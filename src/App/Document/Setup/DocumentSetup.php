<?php


namespace Nemundo\Process\App\Document\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\App\Document\Data\DocumentType\DocumentType;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\Type\FileContentType;
use Schleuniger\App\Projekt\Content\Projekt\ProjektContentType;

class DocumentSetup extends ContentTypeSetup
{
    public function addContentType(AbstractContentType $contentType) {

        parent::addContentType($contentType);

        $data=new DocumentType();
      $data->ignoreIfExists=true;
       $data->contentTypeId=$contentType->typeId;
       $data->save();
    }

}