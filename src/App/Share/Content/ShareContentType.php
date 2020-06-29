<?php


namespace Nemundo\Process\App\Share\Content;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Process\App\Notification\Type\NotificationTrait;
use Nemundo\Process\App\Share\Data\Share\Share;
use Nemundo\Process\App\Share\Data\Share\ShareReader;
use Nemundo\Process\App\Share\Data\Share\ShareRow;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class ShareContentType extends AbstractTreeContentType
{

    use NotificationTrait;

    public $toId;

    public $message;

    protected function loadContentType()
    {

        $this->typeLabel[LanguageCode::EN] = 'Share';
        $this->typeLabel[LanguageCode::DE] = 'Teilen';
        $this->typeId = '8157ca18-edb3-4654-8e9f-d952d942b9a5';
        $this->formClass = ShareContentForm::class;

    }


    protected function onCreate()
    {

        $data = new Share();
        $data->toId = $this->toId;
        $data->message = $this->message;
        $this->dataId = $data->save();

    }


    protected function onFinished()
    {

        $this->sendUserNotification($this->toId);

    }


    protected function onIndex()
    {

        $this->saveNotificationIndex();

    }


    protected function onDataRow()
    {

        $reader = new ShareReader();
        $reader->model->loadTo();
        $this->dataRow = $reader->getRowById($this->dataId);

    }


    /**
     * @return \Nemundo\Model\Row\AbstractModelDataRow|ShareRow
     */
    public function getDataRow()
    {
        return parent::getDataRow();
    }


    public function getSubject()
    {
        return $this->getParentContentType()->getSubject();
    }

    public function getViewSite()
    {
        return $this->getParentContentType()->getViewSite();
    }


    public function getMessage()
    {
      return  $this->getDataRow()->message;
    }


    public function getLog()
    {

        $log = 'Beitrag wurde geteilt mit  ' . $this->getDataRow()->to->displayName;
        return $log;

    }

}