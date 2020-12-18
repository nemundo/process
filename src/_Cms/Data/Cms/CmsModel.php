<?php
namespace Nemundo\Process\Cms\Data\Cms;
class CmsModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $parentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $parent;

/**
* @var \Nemundo\Model\Type\External\Id\ExternalIdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $itemOrder;

protected function loadModel() {
$this->tableName = "cms_cms";
$this->aliasTableName = "cms_cms";
$this->label = "Cms";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "cms_cms";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "cms_cms_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->parentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->parentId->tableName = "cms_cms";
$this->parentId->fieldName = "parent";
$this->parentId->aliasFieldName = "cms_cms_parent";
$this->parentId->label = "Parent";
$this->parentId->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "cms_cms";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "cms_cms_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->itemOrder = new \Nemundo\Model\Type\Number\NumberType($this);
$this->itemOrder->tableName = "cms_cms";
$this->itemOrder->fieldName = "item_order";
$this->itemOrder->aliasFieldName = "cms_cms_item_order";
$this->itemOrder->label = "Item Order";
$this->itemOrder->allowNullValue = false;

}
public function loadParent() {
if ($this->parent == null) {
$this->parent = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "cms_cms_parent");
$this->parent->tableName = "cms_cms";
$this->parent->fieldName = "parent";
$this->parent->aliasFieldName = "cms_cms_parent";
$this->parent->label = "Parent";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "cms_cms_content");
$this->content->tableName = "cms_cms";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "cms_cms_content";
$this->content->label = "Content";
}
return $this;
}
}