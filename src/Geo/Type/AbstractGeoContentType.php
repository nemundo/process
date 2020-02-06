<?php


namespace Nemundo\Process\Geo\Type;


use Nemundo\Core\Type\Geo\GeoCoordinate;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;
use Nemundo\Process\Geo\Data\Geo\Geo;

abstract class AbstractGeoContentType extends AbstractTreeContentType
{

    /**
     * @var GeoCoordinate
     */
    public $geoCoordinate;


    public function __construct($dataId = null)
    {
        $this->geoCoordinate=new GeoCoordinate();
        parent::__construct($dataId);
    }


    protected function saveGeo()
    {

        $data = new Geo();
        $data->id = $this->dataId;
        $data->coordinate = $this->geoCoordinate;
        $this->dataId = $data->save();


    }

}