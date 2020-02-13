<?php


namespace Nemundo\Process\Template\Content\YesNo;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateYesNo\TemplateYesNo;

abstract class AbstractYesNoContentType extends AbstractTreeContentType
{

    /**
     * @var bool
     */
    public $yesNo = false;

    protected function onCreate()
    {

        $data=new TemplateYesNo();
        $data->yesNo=$this->yesNo;
        $this->dataId=$data->save();

    }


}