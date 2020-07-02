<?php
namespace Nemundo\Process\Cms\Data\Cms;
class CmsValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var CmsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsModel();
}
}