<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var CmsTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsTypeModel();
}
}