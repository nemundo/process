<?php


namespace Nemundo\Process\Geo\Type;


use Nemundo\Core\Type\Geo\GeoCoordinate;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Geo\Data\Geo\Geo;

abstract class AbstractGeoContentType extends AbstractContentType
{

    /**
     * @var GeoCoordinate
     */
    public $coordinate;



    protected function saveGeo()
    {

        $data = new Geo();
        $data->id = $this->dataId;
        $data->coordinate = $this->coordinate;
        $this->dataId = $data->save();


    }

}