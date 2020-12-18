<?php
namespace Nemundo\Process\Cms\Data\Cms;
class CmsDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var CmsModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsModel();
}
}