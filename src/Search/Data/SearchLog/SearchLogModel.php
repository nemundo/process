<?php
namespace Nemundo\Process\Search\Data\SearchLog;
class SearchLogModel extends \Nemundo\Model\Definition\Model\AbstractModel {
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

protected function loadModel() {
$this->tableName = "process_search_log";
$this->aliasTableName = "process_search_log";
$this->label = "Search Log";

$this->primaryIndex = new \Nemundo\Db\Index\AutoIncrementIdPrimaryIndex();

$this->id = new \Nemundo\Model\Type\Id\IdType($this);
$this->id->tableName = "process_search_log";
$this->id->fieldName = "id";
$this->id->aliasFieldName = "process_search_log_id";
$this->id->label = "Id";
$this->id->allowNullValue = false;
$this->id->visible->form = false;
$this->id->visible->table = false;
$this->id->visible->view = false;
$this->id->visible->form = false;

$this->searchQuery = new \Nemundo\Model\Type\Text\TextType($this);
$this->searchQuery->tableName = "process_search_log";
$this->searchQuery->fieldName = "search_query";
$this->searchQuery->aliasFieldName = "process_search_log_search_query";
$this->searchQuery->label = "Search Query";
$this->searchQuery->allowNullValue = false;
$this->searchQuery->length = 255;

$this->resultCount = new \Nemundo\Model\Type\Number\NumberType($this);
$this->resultCount->tableName = "process_search_log";
$this->resultCount->fieldName = "result_count";
$this->resultCount->aliasFieldName = "process_search_log_result_count";
$this->resultCount->label = "Result Count";
$this->resultCount->allowNullValue = false;

}
}