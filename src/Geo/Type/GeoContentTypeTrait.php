<?php


namespace Nemundo\Process\Geo\Type;


use Nemundo\Process\Geo\Data\Geo\Geo;

trait GeoContentTypeTrait
{

    abstract public function getCoordinate();


    protected function saveGeoIndex()
    {

        $data = new Geo();
        $data->id = $this->dataId;
        $data->coordinate = $this->geoCoordinate;
        $data->save();


    }


}