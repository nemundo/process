<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedBulk extends \Nemundo\Model\Data\AbstractModelDataBulk {
/**
* @var CmsFeedModel
*/
protected $model;

/**
* @var string
*/
public $feedId;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
public function save() {
$this->typeValueList->setModelValue($this->model->feedId, $this->feedId);
$id = parent::save();
return $id;
}
}