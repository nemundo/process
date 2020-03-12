<?php


namespace Nemundo\Process\Template\Content\Date;


use Nemundo\Core\Type\DateTime\Date;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Data\TemplateDate\TemplateDate;
use Nemundo\Process\Template\Data\TemplateDate\TemplateDateReader;

abstract class AbstractDateContentType extends AbstractTreeContentType
{

    /**
     * @var Date
     */
    public $date;


    public function __construct($dataId = null)
    {
        $this->typeLabel = 'Datum';
        $this->viewClass = DateContentView::class;
        $this->date = new Date();
        parent::__construct($dataId);

    }


    protected function onCreate()
    {
        $data = new TemplateDate();
        $data->date = $this->date;
        $this->dataId = $data->save();
    }


    public function getDataRow()
    {

        return (new TemplateDateReader())->getRowById($this->dataId);

    }

}