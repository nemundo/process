<?php


namespace Nemundo\Process\Template\Content\ImageList;


use Nemundo\Process\Content\Type\AbstractTreeContentType;


// Image List
class ImageListContentType extends AbstractImageListContentType // AbstractTreeContentType
{

    protected function loadContentType()
    {

      //  parent::loadContentType();

        $this->typeLabel='Image List';
        $this->typeId='b9e9c806-cbfd-44ab-8c81-d56dd7592ee8';

        // TODO: Implement loadContentType() method.
    }

}