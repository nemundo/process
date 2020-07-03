<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var CmsTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsTypeModel();
}
}