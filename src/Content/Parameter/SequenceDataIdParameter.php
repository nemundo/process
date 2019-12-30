<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class SequenceDataIdParameter extends DataIdParameter
{

    protected function loadParameter()
    {
        $this->parameterName='sequence-data-id';
    }


    public function getContentType() {

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $row =$reader->getRowById($this->getValue());
       $contentType= $row->contentType->getContentType();
return $contentType;
    }

}