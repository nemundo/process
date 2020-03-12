<?php
namespace Nemundo\Process\App\Favorite\Data\Favorite;
class FavoriteDelete extends \Nemundo\Model\Delete\AbstractModelDelete {
/**
* @var FavoriteModel
*/
public $model;

public function __construct() {
parent::__construct();
$this->model = new FavoriteModel();
}
}