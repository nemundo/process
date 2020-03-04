<?php


namespace Nemundo\Process\App\Assignment\Com\ListBox;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Package\Bootstrap\FormElement\BootstrapListBox;
use Nemundo\Process\App\Assignment\Data\AssignmentSource\AssignmentSourceReader;
use Nemundo\Process\App\Assignment\Data\AssignmentStatus\AssignmentStatusReader;
use Nemundo\Process\App\Assignment\Parameter\SourceParameter;

class AssignmentSourceListBox extends BootstrapListBox
{

    public function getContent()
    {

        $this->label[LanguageCode::EN] ='Source';
        $this->label[LanguageCode::DE] ='Quelle';

        $this->name = (new SourceParameter())->getParameterName();

        $reader = new AssignmentSourceReader();
        $reader->model->loadSource();
        $reader->addOrder($reader->model->source->contentType);
        foreach ($reader->getData() as $statusRow) {
            $this->addItem($statusRow->sourceId,$statusRow->source->contentType);
        }

        return parent::getContent();

    }

}