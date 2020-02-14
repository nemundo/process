<?php


namespace Nemundo\Process\Template\Content\DecimalNumber;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateDecimalNumber\TemplateDecimalNumber;
use Nemundo\Process\Template\Data\TemplateDecimalNumber\TemplateDecimalNumberReader;

abstract class AbstractDecimalNumberContentType extends AbstractTreeContentType
{

    public $decimalNumber;


    public function __construct($dataId = null)
    {

        parent::__construct($dataId);
        $this->viewClass=DecimalNumberContentView::class;

    }


    protected function onCreate()
    {

        $data=new TemplateDecimalNumber();
        $data->decimalNumber=$this->decimalNumber;
        $this->dataId=$data->save();

    }

    public function getDataRow()
    {
        return (new TemplateDecimalNumberReader())->getRowById($this->dataId);
    }


}