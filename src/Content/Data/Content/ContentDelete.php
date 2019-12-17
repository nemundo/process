<?php
namespace Nemundo\Process\Content\Data\Content;
class ContentDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var ContentModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new ContentModel();
}
}