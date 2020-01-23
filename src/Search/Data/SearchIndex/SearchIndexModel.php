<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndexModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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
* @var \Nemundo\Model\Type\External\Id\ExternalUniqueIdType
*/
public $wordId;

/**
* @var \Nemundo\Process\Search\Data\Word\WordExternalType
*/
public $word;

protected function loadModel() {
$this->tableName = "process_search_index";
$this->aliasTableName = "process_search_index";
$this->label = "Search Index";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_search_index";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_search_index_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->contentId = new \Nemundo\Model\Type\External\Id\ExternalIdType($this);
$this->contentId->tableName = "process_search_index";
$this->contentId->fieldName = "content";
$this->contentId->aliasFieldName = "process_search_index_content";
$this->contentId->label = "Content";
$this->contentId->allowNullValue = false;

$this->wordId = new \Nemundo\Model\Type\External\Id\ExternalUniqueIdType($this);
$this->wordId->tableName = "process_search_index";
$this->wordId->fieldName = "word";
$this->wordId->aliasFieldName = "process_search_index_word";
$this->wordId->label = "Word";
$this->wordId->allowNullValue = false;

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "word";
$index->addType($this->wordId);

$index = new \Nemundo\Model\Definition\Index\ModelIndex($this);
$index->indexName = "content";
$index->addType($this->contentId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType($this, "process_search_index_content");
$this->content->tableName = "process_search_index";
$this->content->fieldName = "content";
$this->content->aliasFieldName = "process_search_index_content";
$this->content->label = "Content";
}
return $this;
}
public function loadWord() {
if ($this->word == null) {
$this->word = new \Nemundo\Process\Search\Data\Word\WordExternalType($this, "process_search_index_word");
$this->word->tableName = "process_search_index";
$this->word->fieldName = "word";
$this->word->aliasFieldName = "process_search_index_word";
$this->word->label = "Word";
}
return $this;
}
}