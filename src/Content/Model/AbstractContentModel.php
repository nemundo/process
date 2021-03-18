<?php


namespace Nemundo\Process\Content\Model;


use Nemundo\Core\Language\LanguageCode;
use Nemundo\Model\Definition\Index\ModelIndex;
use Nemundo\Model\Definition\Index\ModelUniqueIndex;
use Nemundo\Model\Definition\Model\AbstractModel;
use Nemundo\Model\Type\DateTime\DateTimeType;
use Nemundo\Model\Type\DateTime\DateType;
use Nemundo\Model\Type\External\Id\ExternalIdType;
use Nemundo\Model\Type\External\Id\ExternalUniqueIdType;
use Nemundo\Model\Type\Number\NumberType;
use Nemundo\Model\Type\Number\YesNoType;
use Nemundo\Model\Type\Text\TextType;
use Nemundo\Process\Content\Data\Content\ContentExternalType;
use Nemundo\Process\Content\Data\ContentType\ContentTypeExternalType;
use Nemundo\Process\Group\Data\Group\GroupExternalType;
use Nemundo\User\Data\User\UserExternalType;

abstract class AbstractContentModel extends AbstractModel
{

    /**
     * @var YesNoType
     */
    public $active;

    /**
     * @var \Nemundo\Model\Type\External\Id\ExternalIdType
     */
    public $contentId;

    /**
     * @var \Nemundo\Process\Content\Data\Content\ContentExternalType
     */
    public $content;


    public function __construct()
    {

        parent::__construct();


        $this->active = new YesNoType($this);
        $this->active->label = 'Active';
        $this->active->fieldName = 'active';
        $this->active->aliasFieldName = $this->tableName . '_active';
        $this->active->tableName = $this->tableName;
        //$this->active
        //$this->active->defaultValue = true;

        $this->contentId = new ExternalIdType($this);
        $this->contentId->tableName = $this->tableName;
        $this->contentId->fieldName = 'content';
        $this->contentId->aliasFieldName = $this->tableName . '_content';
        $this->contentId->label = 'Content';
        $this->contentId->allowNullValue = true;

        $index = new ModelIndex($this);
        $index->indexName = 'content';
        $index->addType($this->contentId);

    }


    public function loadContent()
    {
        if ($this->content == null) {
            $this->content = new ContentExternalType($this, $this->tableName. '_content');
            $this->content->tableName = $this->tableName;
            $this->content->fieldName = 'content';
            $this->content->aliasFieldName = $this->tableName . '_content';
            $this->content->label = 'Content';
        }
        return $this;
    }

}