<?php


namespace Nemundo\Process\Template\Status\File;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\Template\Content\File\AbstractFileContentType;
use Nemundo\Process\Workflow\Content\Status\ProcessStatusTrait;

class FileProcessStatus extends AbstractFileContentType
{

    use ProcessStatusTrait;

    protected function loadContentType()
    {

        $this->typeLabel='Process File';
        $this->typeId = '3068d813-43f7-4e7c-86a2-041f38bf4ec7';

        // TODO: Implement loadContentType() method.
    }


    protected function onFinished()
    {
        parent::onFinished(); // TODO: Change the autogenerated stub



        $this->sendFavoriteNotification($this->getParentProcess());



    }


    protected function onIndex()
    {

        parent::onIndex(); // TODO: Change the autogenerated stub
        $this->saveNotificationIndex();

    }


    public function getSubject()
    {
        return $this->getParentProcess()->getSubject();
    }


    public function getViewSite()
    {
        return $this->getParentProcess()->getViewSite();
    }

}