<?php
namespace Nemundo\Process\App\Wiki\Data\Wiki;
class WikiRow extends \Nemundo\Model\Row\AbstractModelDataRow {
/**
* @var \Nemundo\Model\Row\AbstractModelDataRow
*/
private $row;

/**
* @var WikiModel
*/
public $model;

/**
* @var string
*/
public $id;

/**
* @var string
*/
public $title;

public function __construct(\Nemundo\Db\Row\AbstractDataRow $row, $model) {
parent::__construct($row->getData());
$this->row = $row;
$this->id = $this->getModelValue($model->id);
$this->title = $this->getModelValue($model->title);
}
}