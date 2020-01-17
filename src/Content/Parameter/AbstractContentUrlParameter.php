<?php


namespace Nemundo\Process\Content\Parameter;


use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Web\Parameter\AbstractUrlParameter;

abstract class AbstractContentUrlParameter extends AbstractUrlParameter
{

    public function getContentType()
    {

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $contentRow = $reader->getRowById($this->getValue());
        $contentType = $contentRow->getContentType();

        return $contentType;

    }

}