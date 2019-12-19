<?php


namespace Nemundo\Process\Template\Status;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Workflow\Content\Status\AbstractProcessStatus;
use Nemundo\Process\Template\Form\CommentForm;
use Nemundo\Process\Template\View\CommentView;


// AbstractLargeTextStatus
class CommentProcessStatus extends AbstractProcessStatus
{

    public function __construct()
    {

        $this->label[LanguageCode::EN] = 'Comment';
        $this->label[LanguageCode::DE] = 'Kommentar';
        $this->id = '63fa85d4-4c49-42cc-bd0d-af00a7d96458';
        $this->changeStatus = false;
        $this->formClass = CommentForm::class;

        parent::__construct();
    }

    protected function loadContentType()
    {

        $this->formClass = CommentForm::class;
        $this->viewClass = CommentView::class;


    }

}