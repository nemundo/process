<?php


namespace Nemundo\Process\App\Plz\Content;


use Nemundo\Process\App\Plz\Data\Plz\Plz;
use Nemundo\Process\App\Plz\Data\Plz\PlzReader;
use Nemundo\Process\Geo\Item\AbstractGeoContentItem;

class PlzContentItem extends AbstractGeoContentItem
{

    public $plz;

    public $ort;


    protected function saveData()
    {

        $this->contentType = new PlzContentType();

        $data = new Plz();
        $data->id = $this->dataId;
        $data->plz = $this->plz;
        $data->ort = $this->ort;
        $data->save();

        $this->addSearchWord($this->plz);
        $this->addSearchText($this->ort);


    }


    public function getSubject()
    {

        $plzRow = (new PlzReader())->getRowById($this->dataId);
        $subject = $plzRow->plz . ' ' . $plzRow->ort;

        return $subject;

    }


}