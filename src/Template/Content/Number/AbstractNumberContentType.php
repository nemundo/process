<?php


namespace Nemundo\Process\Template\Content\Number;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateNumber\TemplateNumber;
use Nemundo\Process\Template\Data\TemplateNumber\TemplateNumberReader;

abstract class AbstractNumberContentType extends AbstractTreeContentType
{

    public $number;


    public function __construct($dataId = null)
    {

        $this->viewClass = NumberContentView::class;

        parent::__construct($dataId);
    }


    protected function onCreate()
    {

        $data=new TemplateNumber();
        $data->number=$this->number;
        $this->dataId=$data->save();

    }


    public function getDataRow()
    {

        return (new TemplateNumberReader())->getRowById($this->dataId);

    }


}