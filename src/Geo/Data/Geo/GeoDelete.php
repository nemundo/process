<?php
namespace Nemundo\Process\Geo\Data\Geo;
class GeoDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var GeoModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new GeoModel();
}
}