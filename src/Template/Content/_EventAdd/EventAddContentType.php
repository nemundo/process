<?php


namespace Nemundo\Process\Template\Content\EventAdd;


use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\User\Access\UserRestrictionTrait;

class EventAddContentType extends AbstractTreeContentType
{

    use UserRestrictionTrait;

    protected function loadContentType()
    {
    $this->typeLabel ='Add Event';
    $this->typeId='e1d1b8ea-2607-4b20-9047-855127281454';
    $this->formClass=EventAddForm::class;
    }




}