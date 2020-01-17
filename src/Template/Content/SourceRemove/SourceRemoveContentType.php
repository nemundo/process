<?php


namespace Nemundo\Process\Template\Content\SourceRemove;


use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Parameter\ContentParameter;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Template\Content\Source\AbstractSourceContentType;
use Nemundo\Process\Template\Data\SourceLog\SourceLog;

class SourceRemoveContentType extends AbstractSourceContentType
{


   public $removeId;


    protected function loadContentType()
    {
        $this->typeLabel = 'Source Remove';
        $this->typeId = 'd7efe498-7cc3-4ff0-abfd-99be494a168f';
        // TODO: Implement loadContentType() method.
    }

    protected function onCreate()
    {

        $contentType = (new ContentParameter())->getContentType();
        $contentType->removeChild($this->removeId);

        $delete = new TreeDelete();
        $delete->filter->andEqual($delete->model->parentId,$this->parentId);
        $delete->filter->andEqual($delete->model->childId, $this->removeId);
        $delete->delete();

        $data = new SourceLog();
        $data->sourceId = $this->removeId;
        $this->dataId = $data->save();


    }




    public function getSubject()
    {

        $subject= 'Source '.$this->getHyperlinkContent().' was removed';
        return $subject;

    }

}