<?php


namespace Nemundo\Process\Template\Content\File;


use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Template\Form\FileContentForm;
use Nemundo\Process\Template\View\DocumentContentView;


// wird zu File!!!
class FileContentType extends AbstractContentType
{

    protected function loadContentType()
    {

        $this->typeId = 'bdd5f6d4-baf5-4950-a3aa-051dae4a4df5';
        $this->typeLabel = 'File';
        $this->formClass = FileContentForm::class;
        $this->viewClass = DocumentContentView::class;

    }

}