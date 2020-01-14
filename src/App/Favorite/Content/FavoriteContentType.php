<?php


namespace Nemundo\Process\App\Favorite\Content;


use Nemundo\Process\App\Favorite\Com\FavoriteContainer;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class FavoriteContentType extends AbstractTreeContentType
{
    protected function loadContentType()
    {
        $this->typeId = 'e939872a-45a7-4ff0-837d-6091e15a57a4';
        $this->typeLabel = 'Favorite';
        $this->listClass = FavoriteContainer::class;
        $this->formClass = FavoriteContentForm::class;
    }


    public function getSubject()
    {

        $subject = '';

        $contentReader= new ContentReader();
        $contentReader->model->loadUser();
        foreach ($contentReader->getData() as $contentRow) {
        //$contentRow =$contentReader->getRowById($this->dataId);
        $subject = 'Wurde von '.$contentRow->user->login.' zu den Favoriten hinzugefügt';
        }


        return $subject;

    }

}