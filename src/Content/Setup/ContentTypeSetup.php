<?php


namespace Nemundo\Process\Content\Setup;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Data\ContentType\ContentType;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;

class ContentTypeSetup extends AbstractBase
{

    public function addContentType(AbstractContentType $contentType) {


        // class falls kein type definiert

        $type = (new Translation())->getText( $contentType->type);

        if ($type == null) {
            $type = $contentType->getClassNameWithoutNamespace();
        }

        $data = new ContentType();
        $data->updateOnDuplicate=true;
        $data->id=$contentType->id;
        $data->contentType=$type;
        $data->phpClass=$contentType->getClassName();
        $data->save();

        return $this;
    }



    public function removeContentType(AbstractContentType $contentType) {



        // tree delete



        $delete = new ContentDelete();
        $delete->filter->andEqual($delete->model->contentTypeId,$contentType->id);
        $delete->delete();


        /*
        $delete = new SearchIndexDelete();
        //$delete->model->loadContent();
        $delete->filter->andEqual($delete->model->content->contentTypeId,  $contentType->id);
        $delete->delete();*/



        // delete content
        return $this;
    }


}