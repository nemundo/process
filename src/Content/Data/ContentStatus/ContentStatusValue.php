<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatusValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var ContentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentStatusModel();
}
}