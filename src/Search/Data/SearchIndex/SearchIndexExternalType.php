<?php
namespace Nemundo\Process\Search\Data\SearchIndex;
class SearchIndexExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $contentId;

/**
* @var \Nemundo\Process\Content\Data\Content\ContentExternalType
*/
public $content;

/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $wordId;

/**
* @var \Nemundo\Process\Search\Data\Word\WordExternalType
*/
public $word;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = SearchIndexModel::class;
$this->externalTableName = "search_search_index";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->contentId = new \Nemundo\Model\Type\Id\IdType();
$this->contentId->fieldName = "content";
$this->contentId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->contentId->aliasFieldName = $this->contentId->tableName ."_".$this->contentId->fieldName;
$this->contentId->label = "Content";
$this->addType($this->contentId);

$this->wordId = new \Nemundo\Model\Type\Id\IdType();
$this->wordId->fieldName = "word";
$this->wordId->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->wordId->aliasFieldName = $this->wordId->tableName ."_".$this->wordId->fieldName;
$this->wordId->label = "Word";
$this->addType($this->wordId);

}
public function loadContent() {
if ($this->content == null) {
$this->content = new \Nemundo\Process\Content\Data\Content\ContentExternalType(null, $this->parentFieldName . "_content");
$this->content->fieldName = "content";
$this->content->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->content->aliasFieldName = $this->content->tableName ."_".$this->content->fieldName;
$this->content->label = "Content";
$this->addType($this->content);
}
return $this;
}
public function loadWord() {
if ($this->word == null) {
$this->word = new \Nemundo\Process\Search\Data\Word\WordExternalType(null, $this->parentFieldName . "_word");
$this->word->fieldName = "word";
$this->word->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->word->aliasFieldName = $this->word->tableName ."_".$this->word->fieldName;
$this->word->label = "Word";
$this->addType($this->word);
}
return $this;
}
}