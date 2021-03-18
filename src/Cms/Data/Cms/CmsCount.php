<?php
namespace Nemundo\Process\Cms\Data\Cms;
class CmsCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var CmsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsModel();
}
}