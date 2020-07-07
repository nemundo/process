<?php
namespace Nemundo\Process\App\Feed\Data\CmsFeed;
use Nemundo\Model\Id\AbstractModelIdValue;
class CmsFeedId extends AbstractModelIdValue {
/**
* @var CmsFeedModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new CmsFeedModel();
}
}