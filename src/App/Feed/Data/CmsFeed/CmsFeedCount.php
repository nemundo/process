<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedCount extends \Nemundo\Model\Count\AbstractModelDataCount {
/**
* @var CmsFeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
}