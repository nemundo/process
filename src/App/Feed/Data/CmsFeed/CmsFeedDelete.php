<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
class CmsFeedDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var CmsFeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
}