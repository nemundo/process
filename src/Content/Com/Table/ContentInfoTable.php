<?php


namespace Nemundo\Process\Content\Com\Table;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Html\Formatting\Bold;
use Nemundo\Process\Content\Row\ContentCustomRow;
use Nemundo\Process\Group\Type\GroupContentType;
use Schleuniger\App\ChangeRequest\Row\EcrCustomRow;

class ContentInfoTable extends AdminLabelValueTable
{

    /**
     * @var ContentCustomRow
     */
    public $contentRow;

    public function addDefault()
    {


        $this->addCreator();
        $this->addSubject();

    }


    public function addSubject()
    {
        $this->addLabelValue($this->contentRow->model->subject->label, $this->contentRow->subject);
        return $this;
    }



    public function addCreator()
    {
        $this->addLabelValue('Ersteller', $this->contentRow->user->displayName);
        $this->addLabelValue('Date/Time', $this->contentRow->dateTime);
        return $this;
    }


    public function getContent()
    {





        return parent::getContent(); // TODO: Change the autogenerated stub
    }


}