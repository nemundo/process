<?php
namespace Nemundo\Process\Content\Data\ContentType;
class ContentTypeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var ContentTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentTypeModel();
}
}