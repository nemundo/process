<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\Data\LargeText\LargeText;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Template\Form\CommentForm;
use Nemundo\Process\Template\View\CommentView;


// AbstractLargeTextStatus
class CommentProcessStatus extends AbstractProcessStatus
{

    public $comment;

    public function __construct()
    {

        $this->contentLabel[LanguageCode::EN] = 'Comment';
        $this->contentLabel[LanguageCode::DE] = 'Kommentar';
        $this->contentId = '63fa85d4-4c49-42cc-bd0d-af00a7d96458';
        $this->changeStatus = false;
        $this->formClass = CommentForm::class;

        parent::__construct();
    }

    protected function loadContentType()
    {

        $this->formClass = CommentForm::class;
        $this->viewClass = CommentView::class;

    }

    protected function onCreate()
    {

        $data = new LargeText();
        $data->id=$this->dataId;
        $data->largeText = $this->comment;
        $data->save();


        $this->addSearchText($this->comment);

    }

}