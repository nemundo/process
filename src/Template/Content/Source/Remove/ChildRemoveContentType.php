<?php


namespace Nemundo\Process\Template\Content\Source\Remove;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;

class ChildRemoveContentType extends AbstractSourceContentType
{


    public $removeId;


    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Remove Child';
        $this->typeLabel[LanguageCode::DE] = 'Aufgabe entfernen';
        $this->typeId = '231b32b0-3629-4741-8c91-fa79cc6229e4';

        $this->formClass = SourceRemoveContentPanel::class;

    }

    protected function onCreate()
    {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId, $this->parentId);
        $delete->filter->andEqual($delete->model->childId, $this->removeId);
        $delete->delete();

        $data = new SourceLog();
        $data->sourceId = $this->removeId;
        $this->dataId = $data->save();


        $contentReader = new ContentReader();
        $contentReader->model->loadContentType();
        $contentType = $contentReader->getRowById($this->removeId)->getContentType();

        $contentType->saveIndex();


    }


    public function getSubject()
    {

        $subject[LanguageCode::EN] = 'Task/Child ' . $this->getHyperlinkContent() . ' was removed';
        $subject[LanguageCode::DE] = 'Aufgabe ' . $this->getHyperlinkContent() . ' wurde entfernt';

        return (new Translation())->getText($subject);

    }

}