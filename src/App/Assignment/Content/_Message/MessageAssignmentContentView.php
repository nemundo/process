<?php


namespace Nemundo\Process\App\Assignment\Content\Message;


use Nemundo\Admin\Com\Table\AdminLabelValueTable;
use Nemundo\Html\Block\Div;
use Nemundo\Process\Content\View\AbstractContentView;

class MessageAssignmentContentView extends AbstractContentView
{
    /**
     * @var MessageAssignmentContentType
     */
    public $contentType;

    public function getContent()
    {

        $assignmentRow = $this->contentType->getDataRow();

        $div =new Div($this);
        //$div->content=   $assignmentRow->message;

        $table = new AdminLabelValueTable($this);
        $table->addLabelValue('Zuweisung', $assignmentRow->assignment->group);
        //$table->addLabelValue('Erledigen bis', $assignmentRow->deadline->getShortDateLeadingZeroFormat());



        return parent::getContent();
    }

}