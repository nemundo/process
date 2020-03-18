<?php
namespace Nemundo\Process\Template\Data\TemplateImageIndex;
class TemplateImageIndexModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
* @var \Nemundo\Model\Type\Text\TextType
*/
public $urlSmall;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $urlLarge;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $itemOrder;

protected function loadModel() {
$this->tableName = "template_template_image_index";
$this->aliasTableName = "template_template_image_index";
$this->label = "Template Image Index";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "template_template_image_index";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "template_template_image_index_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->parentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->parentId->tableName = "template_template_image_index";
$this->parentId->fieldName = "parent";
$this->parentId->aliasFieldName = "template_template_image_index_parent";
$this->parentId->label = "Parent";
$this->parentId->allowNullValue = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "template_template_image_index";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "template_template_image_index_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->urlSmall = new \Nemundo\Model\Type\Text\TextType($this);
$this->urlSmall->tableName = "template_template_image_index";
$this->urlSmall->fieldName = "url_small";
$this->urlSmall->aliasFieldName = "template_template_image_index_url_small";
$this->urlSmall->label = "Url Small";
$this->urlSmall->allowNullValue = false;
$this->urlSmall->length = 255;

$this->urlLarge = new \Nemundo\Model\Type\Text\TextType($this);
$this->urlLarge->tableName = "template_template_image_index";
$this->urlLarge->fieldName = "url_large";
$this->urlLarge->aliasFieldName = "template_template_image_index_url_large";
$this->urlLarge->label = "Url Large";
$this->urlLarge->allowNullValue = false;
$this->urlLarge->length = 255;

$this->itemOrder = new \Nemundo\Model\Type\Number\NumberType($this);
$this->itemOrder->tableName = "template_template_image_index";
$this->itemOrder->fieldName = "item_order";
$this->itemOrder->aliasFieldName = "template_template_image_index_item_order";
$this->itemOrder->label = "Item Order";
$this->itemOrder->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "parent_content";
$index->addType($this->parentId);
$index->addType($this->contentId);

}
public function loadParent() {
if ($this->parent == null) {
$this->parent = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "template_template_image_index_parent");
$this->parent->tableName = "template_template_image_index";
$this->parent->fieldName = "parent";
$this->parent->aliasFieldName = "template_template_image_index_parent";
$this->parent->label = "Parent";
}
return $this;
}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "template_template_image_index_content");
$this->content->tableName = "template_template_image_index";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "template_template_image_index_content";
$this->content->label = "Content";
}
return $this;
}
}