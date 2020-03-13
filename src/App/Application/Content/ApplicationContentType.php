<?php


namespace Nemundo\Process\App\Application\Content;


use Nemundo\Process\Content\Type\AbstractContentType;

class ApplicationContentType extends AbstractContentType
{

    protected $applicationId;

    protected function loadContentType()
    {

        $this->typeId = 'edc5b167-3d2c-4e5f-b634-9281e0f6f893';
        $this->typeLabel='Application';

        // TODO: Implement loadContentType() method.
    }


    public function getDataId()
    {
        return $this->applicationId;  // parent::getDataId(); // TODO: Change the autogenerated stub
    }


}