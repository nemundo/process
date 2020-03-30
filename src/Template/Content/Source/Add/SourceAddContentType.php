<?php


namespace Nemundo\Process\Template\Content\Source\Add;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;

class SourceAddContentType extends AbstractSourceContentType
{

    public $sourceId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Add Source';
        $this->typeLabel[LanguageCode::DE] = 'Quelle';

        $this->typeId = 'e40e4360-d630-42e2-a9f9-98a28ea6156d';
        $this->formClass = SourceAddContentContainer::class;

    }


    public function onCreate()
    {

        $data = new SourceLog();
        $data->sourceId = $this->sourceId;
        $this->dataId = $data->save();

        $writer = new TreeWriter();
        $writer->parentId = $this->sourceId;
        $writer->childId = $this->parentId;
        $writer->write();

        $this->getParentContentType()->saveIndex();

    }


    public function saveType()
    {

        $writer = new TreeWriter();
        $writer->parentId = $this->sourceId;
        $writer->childId = $this->parentId;
        if (!$writer->exist()) {
            parent::saveType();
        }

    }


    public function getSubject()
    {

        $subject[LanguageCode::EN] = 'Source ' . $this->getHyperlinkContent() . ' was added';
        $subject[LanguageCode::DE] = 'Quelle ' . $this->getHyperlinkContent() . ' wurde hinzugefügt';

        return (new Translation())->getText($subject);

    }


    public function getLog()
    {

        return $this->getSubject();

    }

}