<?php


namespace Nemundo\Process\App\Favorite\Content;


use Nemundo\Process\App\Favorite\Com\FavoriteContainer;
use Nemundo\Process\Content\Type\AbstractContentType;

class FavoriteContentType extends AbstractContentType
{
    protected function loadContentType()
    {
        $this->contentId = 'e939872a-45a7-4ff0-837d-6091e15a57a4';
        $this->type = 'Favorite';
        $this->listClass=FavoriteContainer::class;
    }
}