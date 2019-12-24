<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var ContentGroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentGroupModel();
}
}