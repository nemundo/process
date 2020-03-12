<?php


namespace Nemundo\Process\Template\Content\YesNo;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateYesNo\TemplateYesNo;
use Nemundo\Process\Template\Data\TemplateYesNo\TemplateYesNoReader;

abstract class AbstractYesNoContentType extends AbstractTreeContentType
{

    /**
     * @var bool
     */
    public $yesNo = false;

    public function __construct($dataId = null)
    {

        $this->viewClass = YesNoContentView::class;
        parent::__construct($dataId);

    }


    protected function onCreate()
    {

        $data = new TemplateYesNo();
        $data->yesNo = $this->yesNo;
        $this->dataId = $data->save();

    }


    public function getDataRow()
    {
        return (new TemplateYesNoReader())->getRowById($this->dataId);
    }

}