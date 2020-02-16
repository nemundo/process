<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Template\View\CommentView;
use Nemundo\Process\Workflow\Content\Process\WorkflowProcess;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;

abstract class AbstractCancelStatus extends AbstractProcessStatus
{

    public $comment;


    public function __construct()
    {

        $this->typeLabel[LanguageCode::EN] = 'Cancel';
        $this->typeLabel[LanguageCode::DE] = 'Abbruch';

        //$this->id='510c9d20-74cc-43b6-82d3-d6a6df487813';

        $this->changeStatus = true;
        $this->closeWorkflow = true;
        parent::__construct();

        $this->viewClass = CommentView::class;

    }


    protected function onCreate()
    {

        $data = new LargeText();
        $data->id = $this->dataId;
        $data->largeText = $this->comment;
        $data->save();

        $item = new WorkflowProcess($this->parentId);
        $item->clearAssignment();

    }


    /*  protected function loadContentType()
      {
          //parent::loadContentType(); // TODO: Change the autogenerated stub




          //$this->formClass = CancelStatusForm::class;


      }*/

}