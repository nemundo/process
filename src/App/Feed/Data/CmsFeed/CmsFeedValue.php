<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedValue extends \Nemundo\Model\Value\AbstractModelDataValue {
/**
* @var CmsFeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
}