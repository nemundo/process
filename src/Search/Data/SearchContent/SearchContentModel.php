<?php
namespace Nemundo\Process\Search\Data\SearchContent;
class SearchContentModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

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
public $title;

/**
* @var \Nemundo\Model\Type\Text\LargeTextType
*/
public $text;

protected function loadModel() {
$this->tableName = "search_search_content";
$this->aliasTableName = "search_search_content";
$this->label = "Search Content";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "search_search_content";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "search_search_content_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "search_search_content";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "search_search_content_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->title = new \Nemundo\Model\Type\Text\TextType($this);
$this->title->tableName = "search_search_content";
$this->title->fieldName = "title";
$this->title->aliasFieldName = "search_search_content_title";
$this->title->label = "Title";
$this->title->allowNullValue = false;
$this->title->length = 255;

$this->text = new \Nemundo\Model\Type\Text\LargeTextType($this);
$this->text->tableName = "search_search_content";
$this->text->fieldName = "text";
$this->text->aliasFieldName = "search_search_content_text";
$this->text->label = "Text";
$this->text->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelUniqueIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "search_search_content_content");
$this->content->tableName = "search_search_content";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "search_search_content_content";
$this->content->label = "Content";
}
return $this;
}
}