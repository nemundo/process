<?php
namespace Nemundo\Process\App\Dashboard\Data\Dashboard;
class DashboardBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var DashboardModel
*/
protected $model;

/**
* @var string
*/
public $contentId;

public function __construct() {
parent::__construct();
$this->model = new DashboardModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->contentId, $this->contentId);
$id = parent::save();
return $id;
}
}