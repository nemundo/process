<?php
namespace Nemundo\Process\Content\Data\ContentStatus;
use Nemundo\Model\Id\AbstractModelIdValue;
class ContentStatusId extends AbstractModelIdValue {
/**
* @var ContentStatusModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentStatusModel();
}
}