<?php


namespace Nemundo\Process\Content\Writer;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\User\Type\UserSessionType;

class ContentWriter extends AbstractBase
{

    /**
     * @var AbstractContentType
     */
    public $contentType;

    public $dataId;


    public $subject;


    /**
     * @var DateTime
     */
    public $dateTime;

    /**
     * @var string
     */
    public $userId;


    public function __construct()
    {

        $this->dateTime =(new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;

    }


    public function write() {

        $data = new Content();
        $data->updateOnDuplicate = true;
        $data->id = $this->dataId;
        $data->contentTypeId = $this->contentType->contentId;
        $data->subject = $this->subject;  //getSubject();
        $data->dateTime =$this->dateTime;
        $data->userId =$this->userId;
        $data->save();

    }

}