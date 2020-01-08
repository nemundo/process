<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\ContentType\ContentTypeReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

class DataIdParameter extends AbstractUrlParameter
{

    protected function loadParameter()
    {
        $this->parameterName='data-id';
    }


    public function getContentType() {

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $row =$reader->getRowById($this->getValue());
       $contentType= $row->getContentType();  //contentType->getContentType();
return $contentType;
    }

}