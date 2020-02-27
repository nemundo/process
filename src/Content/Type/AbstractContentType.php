<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Debug\Debug;
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
use Schleuniger\App\Sitzung\Data\Sitzung\SitzungReader;


abstract class AbstractContentType extends AbstractType
{

    use SearchIndexTrait;

    /**
     * @var DateTime
     */
    public $dateTime;

    /**
     * @var string
     */
    public $userId;

    /**
     * @var string
     */
    public $typeId;

    /**
     * @var string|string[]
     */
    public $typeLabel;


    //public $restricted = false;


    protected $contentId;

    /**
     * @var string
     */
    protected $listClass;

    // parentContainerListClass


    /**
     * @var string
     */
    protected $adminClass;


    /**
     * @var ModelDataRow
     */
    protected $dataRow;

    abstract protected function loadContentType();


    public function __construct($dataId = null)
    {
        parent::__construct($dataId);

        $this->loadContentType();

        if ($this->formClass == null) {
            $this->formClass = ContentForm::class;
        }

        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;

    }


    public function getContentId()
    {

        if ($this->contentId == null) {
            $id = new ContentId();
            $id->filter->andEqual($id->model->contentTypeId, $this->typeId);
            $id->filter->andEqual($id->model->dataId, $this->dataId);
            $this->contentId = $id->getId();
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

    public function existItem()
    {
        //return false;
        $value=false;
        if ($this->dataId !== null) {
            $value = true;
        }

        return $value;

    }


    public function saveType()
    {



        if ($this->existItem()) {
            $this->createMode = false;
        }

        $this->saveContent();
        $this->saveSearchIndex();

        return $this->dataId;

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


            //$stop->stopStopwatch();

            /*$log = new CreateItemContentType();
            $log->parentId=$this->contentId;
            $log->saveType();*/


        } else {

            $this->onUpdate();

            $update = new ContentUpdate();
            $update->subject = $this->getSubject();
            $update->updateById($this->getContentId());

            /*            $log = new EditItemContentType();
                        $log->parentId=$this->contentId;
                        $log->saveType();*/


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



    public function fromDataRow(AbstractModelDataRow $dataRow) {

        $this->dataRow = $dataRow;
        $this->loadFromDataId($dataRow->getModelValue($dataRow->model->id));
        return $this;

    }


    protected function onDataRow() {
        //(new LogMessage())->writeError('getDataRow not defined'.$this->getClassName());
    }

    public function getDataRow()
    {

        if ($this->dataRow ==null) {
          $this->onDataRow();
        }

        return $this->dataRow;


    }


    public function deleteType()
    {

        parent::deleteType();
        (new ContentDelete())->deleteById($this->getContentId());

    }

}