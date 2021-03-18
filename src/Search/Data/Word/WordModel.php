<?php
namespace Nemundo\Process\Search\Data\Word;
class WordModel extends \Nemundo\Model\Definition\Model\AbstractModel {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $word;

protected function loadModel() {
$this->tableName = "process_search_word";
$this->aliasTableName = "process_search_word";
$this->label = "Word";

$this->primaryIndex = new \Nemundo\Db\Index\TextIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_search_word";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_search_word_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;

$this->word = new \Nemundo\Model\Type\Text\TextType($this);
$this->word->tableName = "process_search_word";
$this->word->fieldName = "word";
$this->word->aliasFieldName = "process_search_word_word";
$this->word->label = "Word";
$this->word->allowNullValue = false;
$this->word->length = 50;

$index = new \Nemundo\Model\Definition\Index\ModelSearchIndex($this);
$index->indexName = "word";
$index->addType($this->word);

}
}