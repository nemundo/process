<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLogExternalType extends \Nemundo\Model\Type\External\ExternalType {
/**
* @var \Nemundo\Model\Type\Id\IdType
*/
public $id;

/**
* @var \Nemundo\Model\Type\Text\TextType
*/
public $searchQuery;

/**
* @var \Nemundo\Model\Type\Number\NumberType
*/
public $resultCount;

protected function loadExternalType() {
parent::loadExternalType();
$this->externalModelClassName = SearchLogModel::class;
$this->externalTableName = "process_search_log";
$this->aliasTableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id = new \Nemundo\Model\Type\Id\IdType();
$this->id->fieldName = "id";
$this->id->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->id->aliasFieldName = $this->id->tableName . "_" . $this->id->fieldName;
$this->id->label = "Id";
$this->addType($this->id);

$this->searchQuery = new \Nemundo\Model\Type\Text\TextType();
$this->searchQuery->fieldName = "search_query";
$this->searchQuery->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->searchQuery->aliasFieldName = $this->searchQuery->tableName . "_" . $this->searchQuery->fieldName;
$this->searchQuery->label = "Search Query";
$this->addType($this->searchQuery);

$this->resultCount = new \Nemundo\Model\Type\Number\NumberType();
$this->resultCount->fieldName = "result_count";
$this->resultCount->tableName = $this->parentFieldName . "_" . $this->externalTableName;
$this->resultCount->aliasFieldName = $this->resultCount->tableName . "_" . $this->resultCount->fieldName;
$this->resultCount->label = "Result Count";
$this->addType($this->resultCount);

}
}