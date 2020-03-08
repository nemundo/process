<?php
namespace Nemundo\Process\Relation\Data\Relation;
class RelationPaginationReader extends \Nemundo\Model\Reader\AbstractPaginationModelDataReader {
/**
* @var RelationModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new RelationModel();
}
/**
* @return RelationRow[]
*/
public function getData() {
$list = [];
foreach (parent::getData() as $dataRow) {
$row = new RelationRow($dataRow, $this->model);
$list[] = $row;
}
return $list;
}
}