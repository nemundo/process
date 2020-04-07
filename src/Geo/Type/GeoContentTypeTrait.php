<?php


namespace Nemundo\Process\Geo\Type;


use Nemundo\Process\Geo\Data\Geo\Geo;

trait GeoContentTypeTrait
{


    abstract public function getPlace();

    abstract public function getCoordinate();


    protected function saveGeoIndex()
    {

        $data = new Geo();
        $data->updateOnDuplicate=true;
        $data->place=$this->getPlace();
        $data->coordinate = $this->getCoordinate();
        $data->contentId=$this->getContentId();
        $data->save();


    }


}