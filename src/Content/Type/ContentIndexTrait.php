<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Random\UniqueId;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentId;
use Nemundo\Process\Content\Data\Content\ContentUpdate;
use Nemundo\User\Type\UserSessionType;

trait ContentIndexTrait
{

    abstract public function getSubject();


    /**
     * @var DateTime
     */
    public $dateTime;

    /**
     * @var string
     */
    public $userId;


    protected $contentId;


    protected function loadUserDateTime()
    {

        $this->dateTime = (new DateTime())->setNow();

        if ((new UserSessionType())->isUserLogged()) {
            $this->userId = (new UserSessionType())->userId;
        } else {
            $this->userId = '';
        }

    }


    public function getContentId()
    {

        if ($this->contentId == null) {

//            $this->saveContent();

            if ($this->existContent()) {

                $id = new ContentId();
                $id->filter->andEqual($id->model->contentTypeId, $this->typeId);
                $id->filter->andEqual($id->model->dataId, $this->getDataId());
                $this->contentId = $id->getId();
            }

        }

        return $this->contentId;

    }


    public function existContent()
    {

        $value = true;

        $count = new ContentCount();
        $count->filter->andEqual($count->model->contentTypeId, $this->typeId);
        $count->filter->andEqual($count->model->dataId, $this->dataId);
        if ($count->getCount() == 0) {
            $value = false;
        }

        return $value;

    }


    protected function saveContent()
    {

        // wann braucht's das??? bei status ohne daten z.B. auftragliste
        if ($this->getDataId() == null) {
            $this->dataId = (new UniqueId())->getUniqueId();
        }

        $data = new Content();
        $data->ignoreIfExists = true;
        $data->contentTypeId = $this->typeId;
        $data->dataId = $this->getDataId();
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();

    }



    protected function updateContent()
    {

        $data = new Content();
        $data->updateOnDuplicate=true;
        $data->contentTypeId = $this->typeId;
        $data->dataId = $this->getDataId();
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();

    }




    /*
    protected function saveContent()
    {

        if ($this->createMode) {

            $this->saveContentBefore();
            $this->onCreate();

            if ($this->dataId == null) {
                $this->dataId = (new UniqueId())->getUniqueId();
            }

            $update = new ContentUpdate();
            $update->dataId = $this->dataId;
            $update->subject = $this->getSubject();
            $update->updateById($this->contentId);

        } else {

            $this->onUpdate();

            $update = new ContentUpdate();
            $update->subject = $this->getSubject();
            $update->updateById($this->getContentId());

        }

    }


    protected function saveContentBefore()
    {

        $data = new Content();
        $data->contentTypeId = $this->typeId;
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $this->contentId = $data->save();

    }*/



    // updateContentIndex
    protected function saveContentIndex()
    {

        $update = new ContentUpdate();
        $update->subject = $this->getSubject();
        $update->updateById($this->getContentId());

    }


    protected function deleteContent()
    {

        (new ContentDelete())->deleteById($this->getContentId());


    }


}