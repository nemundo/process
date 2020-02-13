<?php


namespace Nemundo\Process\Template\Content\DecimalNumber;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateDecimalNumber\TemplateDecimalNumber;

abstract class AbstractDecimalNumberContentType extends AbstractTreeContentType
{

    public $decimalNumber;

    protected function onCreate()
    {

        $data=new TemplateDecimalNumber();
        $data->decimalNumber=$this->decimalNumber;
        $this->dataId=$data->save();

    }

}