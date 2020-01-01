<?php


namespace Nemundo\Process\Content\Type;


use Nemundo\Core\Base\AbstractBaseClass;
use Nemundo\Core\Log\LogMessage;
use Nemundo\Core\Type\DateTime\DateTime;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Process\Content\Data\Content\Content;
use Nemundo\Process\Content\Data\Content\ContentDelete;
use Nemundo\Process\Content\Data\ContentGroup\ContentGroup;
use Nemundo\Process\Content\Data\Tree\TreeDelete;
use Nemundo\Process\Content\Form\AbstractContentForm;
use Nemundo\Process\Content\Form\ContentForm;
use Nemundo\Process\Content\Item\AbstractContentItem;
use Nemundo\Process\Content\Item\ContentItem;
use Nemundo\Process\Content\Item\TreeItem;
use Nemundo\Process\Content\Parameter\DataIdParameter;
use Nemundo\Process\Content\Site\ContentItemSite;
use Nemundo\Process\Content\View\AbstractContentList;
use Nemundo\Process\Content\View\AbstractContentView;
use Nemundo\Process\Content\View\ContentView;
use Nemundo\Process\Group\Type\PublicGroup;
use Nemundo\Process\Search\Data\SearchIndex\SearchIndexDelete;
use Nemundo\Process\Search\Index\SearchIndexBuilder;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\View\ViewSiteTrait;


abstract class AbstractContentType extends AbstractType   // AbstractBaseClass
{


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
    public $type;


    public $restricted = false;


    /**
     * @var string
     */
    //protected $formClass;

    /**
     * @var string
     */
    //protected $viewClass;
    // -->


    //protected $dataId;

    /**
     * @var string
     */
    protected $listClass;


    /**
     * @var string
     */
    protected $adminClass;


    //listClass


    // teaserView

    // adminViewClass

    // listViewClass

    // searchViewClass


    /**
     * @var string
     */
    //protected $itemClass;



    /**
     * @var SearchIndexBuilder
     */
    private $searchIndex;



    abstract protected function loadContentType();



    public function __construct($dataId = null)
    {
        parent::__construct($dataId);

        $this->loadContentType();

        if ($this->formClass == null) {
            $this->formClass = ContentForm::class;
        }

        if ($this->viewClass == null) {
            $this->viewClass = ContentView::class;
        }

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



    //public function __construct($dataId = null)
    /*{

        $this->dataId=$dataId;

        if ($this->formClass == null) {
            $this->formClass = ContentForm::class;
        }

        if ($this->viewClass == null) {
            $this->viewClass = ContentView::class;
        }

        if ($this->itemClass == null) {
            $this->itemClass = ContentItem::class;
        }

        if ($this->viewSite == null) {
            $this->viewSite = ContentItemSite::$site;
        }

        if ($this->parameterClass == null) {
            $this->parameterClass = DataIdParameter::class;
        }

        $this->loadContentType();

    }*/





    public function saveType()
    {

        parent::saveType();
        $this->saveContent();

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

        $value = false;
        if ($this->adminClass !== null) {
            $value = true;
        }

        return $value;

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



    protected function saveContent()
    {

        /*
        if ($this->contentType == null) {
            (new LogMessage())->writeError('content type not defined' . $this->getClassName());
        }*/

        $data = new Content();
        $data->updateOnDuplicate = true;
        $data->id = $this->dataId;
        $data->contentTypeId = $this->contentId;
        $data->subject = $this->getSubject();
        $data->dateTime = $this->dateTime;
        $data->userId = $this->userId;
        $data->save();

        /*
        if ($this->parentId !== null) {
            $tree = new TreeItem();
            $tree->parentId = $this->parentId;
            $tree->dataId = $this->dataId;
            $tree->saveTree();
        }*/


        if ($this->searchIndex !== null) {
            $this->searchIndex->saveIndex();
        }


        /*
        if (!$this->contentType->restricted) {
            $data = new ContentGroup();
            $data->ignoreIfExists = true;
            $data->contentId = $this->dataId;
            $data->groupId = (new PublicGroup())->id;  // $this->groupId;
            $data->save();
        }*/


    }




    public function deleteItem()
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