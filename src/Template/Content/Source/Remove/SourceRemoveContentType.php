<?php


namespace Nemundo\Process\Template\Content\Source\Remove;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Core\Language\Translation;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;

class SourceRemoveContentType extends AbstractSourceContentType
{

    public $removeId;

    public $editable = true;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Remove Source';
        $this->typeLabel[LanguageCode::DE] = 'Quelle entfernen';
        $this->typeId = 'd7efe498-7cc3-4ff0-abfd-99be494a168f';

        $this->formClass = SourceRemoveContentPanel::class;

    }


    protected function onCreate()
    {

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId, $this->removeId);
        $delete->filter->andEqual($delete->model->childId, $this->parentId);
        $delete->delete();

        $data = new SourceLog();
        $data->sourceId = $this->removeId;
        $this->dataId = $data->save();

        $this->getParentContentType()->saveIndex();

    }


    public function getSubject()
    {

        $subject[LanguageCode::EN] = 'Source ' . $this->getHyperlinkContent() . ' was removed';
        $subject[LanguageCode::DE] = 'Quelle ' . $this->getHyperlinkContent() . ' wurde entfernt';

        return (new Translation())->getText($subject);

    }

}