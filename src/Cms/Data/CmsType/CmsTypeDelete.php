<?php
namespace Nemundo\Process\Cms\Data\CmsType;
class CmsTypeDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var CmsTypeModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsTypeModel();
}
}