<?php
namespace Nemundo\Process\Search\Data\Word;
class WordExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $word;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = WordModel::class;
$this->externalTableName = "search_word";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->word = new \Nemundo\Model\Type\Text\TextType();
$this->word->fieldName = "word";
$this->word->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->word->aliasFieldName = $this->word->tableName . "_" . $this->word->fieldName;
$this->word->label = "Word";
$this->addType($this->word);

}
}