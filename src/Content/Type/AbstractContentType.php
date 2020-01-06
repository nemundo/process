<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Language\Translation;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Form\ContentForm;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Site\ContentItemSite;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\Process\Content\View\ContentView;
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
    public $contentId;

    /**
     * @var string|string[]
     */
    public $contentLabel;


    public $restricted = false;


    /**
     * @var string
     */
    protected $listClass;


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


        /*
        if ($this->viewClass == null) {
            $this->viewClass = ContentView::class;
        }*/

        /* if ($this->itemClass == null) {
             $this->itemClass = ContentItem::class;
         }*/

        if ($this->viewSite == null) {
            $this->viewSite = ContentItemSite::$site;
        }

        if ($this->parameterClass == null) {
            $this->parameterClass = DataIdParameter::class;
        }


        $this->dateTime = (new DateTime())->setNow();
        $this->userId = (new UserSessionType())->userId;


    }


    public function saveType()
    {

        parent::saveType();
        $this->saveContent();

    }


    public function getSubject()
    {


        $subject = '[No Content Type]';

        if ($this->contentLabel !== null) {
            $subject = (new Translation())->getText($this->contentLabel);
        }

        return $subject;

    }


    // move to Item
    /*public function getSubject($dataId)
    {

        $subject = $this->getClassNameWithoutNamespace();
        return $subject;

    }*/


    /*
    public function getItem($dataId)
    {

        /** @var AbstractContentItem $item */
    /*  $item = new $this->itemClass($dataId);

      return $item;

  }*/


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

        if ($this->listClass == null) {
            (new LogMessage())->writeError('No Table' . $this->getClassName());
        }

        /** @var AbstractContentList $list */
        $list = new $this->listClass($parent);

        return $list;

    }


    public function hasAdmin()
    {

        /*$value = false;
        if ($this->adminClass !== null) {
            $value = true;
        }

        return $value;*/

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


    protected function saveContent()
    {


        $writer = new ContentWriter();
        $writer->contentType = $this;
        $writer->dataId = $this->dataId;
        $writer->subject = $this->getSubject();
        $writer->write();

        $this->saveSearchIndex();


        /*
        if (!$this->contentType->restricted) {
            $data = new ContentGroup();
            $data->ignoreIfExists = true;
            $data->contentId = $this->dataId;
            $data->groupId = (new PublicGroup())->id;  // $this->groupId;
            $data->save();
        }*/


    }


    public function getDataRow()
    {
        (new LogMessage())->writeError('getDataRow not defined');
    }


    public function deleteType()
    {

        (new ContentDelete())->deleteById($this->dataId);


        /*
        $delete = new TreeDelete();
        $delete->filter->orEqual($delete->model->parentId, $this->dataId);
        $delete->filter->orEqual($delete->model->childId, $this->dataId);
        $delete->delete();


        $delete = new SearchIndexDelete();
        $delete->filter->andEqual($delete->model->contentId, $this->dataId);
        $delete->delete();


        // delete child
        // kann mehrere items beinhalten !!!*/

    }


}