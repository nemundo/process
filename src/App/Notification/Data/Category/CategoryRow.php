<?php
namespace Nemundo\Process\App\Notification\Data\Category;
class CategoryRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var CategoryModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $category;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->category = $this->getModelValue($model->category);
}
}