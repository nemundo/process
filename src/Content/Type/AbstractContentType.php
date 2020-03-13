<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Language\Translation;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Random\UniqueId;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Model\Row\AbstractModelDataRow;
use Nemundo\Model\Row\ModelDataRow;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentCount;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentId;
use Nemundo\Process\Content\Data\Content\ContentUpdate;
use Nemundo\Process\Content\Form\ContentForm;
use Nemundo\Process\Content\View\AbstractContentAdmin;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\User\Type\UserSessionType;


abstract class AbstractContentType extends AbstractType
{

    use ContentIndexTrait;
    //use SearchIndexTrait;

    /**
     * @var string
     */
    protected $listClass;

    /**
     * @var string
     */
    protected $adminClass;


    public function __construct($dataId = null)
    {

        parent::__construct($dataId);

        if ($this->formClass == null) {
            $this->formClass = ContentForm::class;
        }

        $this->loadUserDateTime();

    }


    public function saveType()
    {

        $this->saveData();
        $this->saveContent();
        //$this->onFinished();
        $this->saveIndex();

    }


    /*
    protected function saveContentIndex2() {

        $data = new Content();
        $data->updateOnDuplicate=true;
        $data->contentTypeId = $this->typeId;
        $data->dataId = $this->dataId;
        $data->subject = $this->getSubject();
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();




    }


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

    }


    protected function saveContentIndex() {

        $update = new ContentUpdate();
        $update->subject = $this->getSubject();
        $update->updateById($this->getContentId());

    }*/


    public function getSubject()
    {

        $subject = '[No Content Type]';

        if ($this->typeLabel !== null) {
            $subject = (new Translation())->getText($this->typeLabel);
        }

        return $subject;

    }


    public function hasList()
    {

        $value = false;
        if ($this->listClass !== null) {
            $value = true;
        }

        return $value;

    }

    public function getList(AbstractHtmlContainer $parent)
    {

        $list = null;

        if ($this->listClass == null) {

            $list = new Paragraph($parent);
            $list->content = '[No List Object]';


        } else {

            /** @var AbstractContentList $list */
            $list = new $this->listClass($parent);

        }

        return $list;

    }


    public function hasAdmin()
    {

        return $this->hasProperty($this->adminClass);

    }


    public function getAdmin(AbstractHtmlContainer $parent)
    {

        $admin = null;
        if ($this->hasAdmin()) {

            /** @var AbstractContentAdmin $admin */
            $admin = new $this->adminClass($parent);
            $admin->contentType = $this;


        } else {
            (new LogMessage())->writeError('No Admin Class. Class: ' . $this->getClassName());
        }

        return $admin;

    }


    private function hasProperty($class)
    {

        $value = false;
        if ($class !== null) {
            $value = true;
        }

        return $value;

    }


    public function getDataReader()
    {
        (new LogMessage())->writeError('getDataReader not defined');
    }


    public function deleteType()
    {

        parent::deleteType();
        $this->deleteContent();

    }

}