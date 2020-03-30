<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;

class ChildAddContentType extends AbstractSourceContentType
{

    public $sourceId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Add Child';
        $this->typeLabel[LanguageCode::DE] = 'Add Child (Aufgabe hinzufügen)';

        $this->typeId = 'bba22817-9b78-40f8-b1fc-2d20372ac891';
        $this->formClass = ChildAddContentContainer::class;

    }


    public function onCreate()
    {

        $data = new SourceLog();
        $data->sourceId = $this->sourceId;
        $this->dataId = $data->save();

        $writer = new TreeWriter();
        $writer->parentId = $this->parentId;
        $writer->childId = $this->sourceId;
        $writer->write();

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        $contentType = $contentReader->getRowById($this->sourceId)->getContentType();

        $contentType->saveIndex();

    }


    public function saveType()
    {

        $writer = new TreeWriter();
        $writer->parentId = $this->parentId;
        $writer->childId = $this->sourceId;
        if (!$writer->exist()) {
            parent::saveType();
        }

    }


    public function getSubject()
    {

        $subject[LanguageCode::EN] = 'Source ' . $this->getHyperlinkContent() . ' was added';
        $subject[LanguageCode::DE] = 'Aufgabe ' . $this->getHyperlinkContent() . ' wurde hinzugefügt';

        return (new Translation())->getText($subject);

    }


    public function getLog()
    {

        return $this->getSubject();

    }

}