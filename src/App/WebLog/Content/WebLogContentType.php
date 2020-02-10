<?php


namespace Nemundo\Process\App\WebLog\Content;


use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class WebLogContentType extends AbstractTreeContentType
{
    protected function loadContentType()
    {
        $this->typeLabel='Web Log';
        $this->typeId='8a11756f-3380-4a3d-8e21-0c51e051c539';

    }


    public function getSubject()
    {

        $contentReader = new ContentReader();
        $contentReader->model->loadUser();
        $contentRow = $contentReader->getRowById($this->getContentId());

        $subject = 'Web View von '.$contentRow->user->displayName;

        return $subject;

    }

}