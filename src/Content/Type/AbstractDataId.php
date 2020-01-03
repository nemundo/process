<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBase;

class AbstractDataId extends AbstractBase
{

    protected $dataId;


    public function __construct($dataId)
    {
        $this->dataId = $dataId;
    }

}