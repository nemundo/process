<?php
namespace Nemundo\Process\Content\Data\ContentGroup;
class ContentGroupDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ContentGroupModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentGroupModel();
}
}