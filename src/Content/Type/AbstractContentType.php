<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Debug\Debug;
use Nemundo\Core\Language\Translation;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Html\Paragraph\Paragraph;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\Content\ContentId;
use Nemundo\Process\Content\Form\ContentForm;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\Process\Content\Writer\ContentWriter;
use Nemundo\User\Type\UserSessionType;


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


    // müsste auch nach ContentItem
    // use ViewSiteTrait;

    /**
     * @var string
     */
    public $typeId;
    // typeId

    /**
     * @var string|string[]
     */
    public $typeLabel;
// typeLabel

    public $restricted = false;


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


    public function saveType()
    {
        (new LogMessage())->writeError('content type');
        exit;
        parent::saveType();
        $this->saveContent();


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

        $list=null;

        if ($this->listClass == null) {
            //(new LogMessage())->writeError('No Table' . $this->getClassName());

            $list=new Paragraph($parent);
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

            /** @var AbstractHtmlContainer $admin */
            $admin = new $this->adminClass($parent);


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



    /*
    protected function saveContent()
    {


        $writer = new ContentWriter();
        $writer->contentType = $this;
        $writer->dataId = $this->dataId;
        $writer->subject = $this->getSubject();
        $this->contentId = $writer->write();

        $this->saveSearchIndex();


        /*
        if (!$this->contentType->restricted) {
            $data = new ContentGroup();
            $data->ignoreIfExists = true;
            $data->contentId = $this->dataId;
            $data->groupId = (new PublicGroup())->id;  // $this->groupId;
            $data->save();
        }*/

   /*     return $this->contentId;


    }*/


    public function getDataRow()
    {
        (new LogMessage())->writeError('getDataRow not defined');
    }


    public function deleteType()
    {

        parent::deleteType();
        //(new ContentDelete())->deleteById($this->dataId);

        //(new Debug())->write($this->getContentId());

        (new ContentDelete())->deleteById($this->getContentId());

    }


}