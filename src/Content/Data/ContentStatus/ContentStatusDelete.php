<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
class ContentStatusDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ContentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentStatusModel();
}
}