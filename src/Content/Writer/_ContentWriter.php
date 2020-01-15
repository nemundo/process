<?php


namespace Nemundo\Process\Content\Writer;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Random\UniqueId;
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

        //$contentId = (new UniqueId())->getUniqueId();

        $data = new Content();
        //$data->updateOnDuplicate = true;
        //$data->id =$contentId;  // (new Uniq) $this->dataId;
        $data->dataId=$this->dataId;
        $data->contentTypeId = $this->contentType->typeId;
        $data->subject = $this->subject;  //getSubject();
        $data->dateTime =$this->dateTime;
        $data->userId =$this->userId;
        $contentId= $data->save();
        //(new Debug())->write($contentId);
        return $contentId;

    }

}