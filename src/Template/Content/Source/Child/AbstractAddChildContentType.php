<?php


namespace Nemundo\Process\Template\Content\Source\Child;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;

use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Writer\TreeWriter;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;

class AbstractAddChildContentType extends AbstractSourceContentType
{

    public $childId;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Add Child';
        $this->typeLabel[LanguageCode::DE] = 'Add Child ';

    }


    public function onCreate()
    {

        $data = new SourceLog();
        $data->sourceId = $this->childId;
        $this->dataId = $data->save();

        $writer = new TreeWriter();
        $writer->parentId = $this->parentId;
        $writer->dataId = $this->childId;
        $writer->write();

        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        $contentType = $contentReader->getRowById($this->childId)->getContentType();
        $contentType->saveIndex();

    }


    public function getSubject()
    {

        $subject[LanguageCode::EN] = 'Item ' . $this->getHyperlinkContent() . ' was added';
        $subject[LanguageCode::DE] = 'Element ' . $this->getHyperlinkContent() . ' wurde hinzugefügt';

        return (new Translation())->getText($subject);

    }

}