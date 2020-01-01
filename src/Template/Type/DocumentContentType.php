<?php


namespace Nemundo\Process\Template\Type;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\Form\DocumentContentForm;
use Nemundo\Process\Template\View\DocumentContentView;

class DocumentContentType extends AbstractContentType
{

    protected function loadContentType()
    {

        $this->contentId = 'bdd5f6d4-baf5-4950-a3aa-051dae4a4df5';
$this->type = 'Document';
        $this->formClass = DocumentContentForm::class;
        $this->viewClass = DocumentContentView::class;

    }

}