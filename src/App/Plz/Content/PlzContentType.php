<?php


namespace Nemundo\Process\App\Plz\Content;


use Nemundo\Core\Debug\Debug;
use Nemundo\Process\App\Plz\Data\Plz\Plz;
use Nemundo\Process\App\Plz\Data\Plz\PlzDelete;
use Nemundo\Process\App\Plz\Data\Plz\PlzReader;
use Nemundo\Process\Content\Type\AbstractContentType;
use Nemundo\Process\Content\Type\AbstractTreeContentType;

class PlzContentType extends AbstractTreeContentType
{

    public $plz;

    public $ort;

    protected function loadContentType()
    {
        $this->typeLabel = 'PLZ';
        $this->typeId = 'a583f8d1-dd76-430d-94bf-a3d77f95cef4';
    }


    protected function onCreate()
    {

        $data = new Plz();
        $data->updateOnDuplicate=true;
        //$data->id = $this->dataId;
        $data->plz = $this->plz;
        $data->ort = $this->ort;
        $this->dataId =$data->save();

        //(new Debug())->write($this->dataId);


    }


    protected function onSearchIndex()
    {

        $this->addSearchWord($this->plz);
        $this->addSearchText($this->ort);

    }

    protected function onDelete()
    {
        (new PlzDelete())->deleteById($this->dataId);
    }


    public function getSubject()
    {

        $plzRow = (new PlzReader())->getRowById($this->dataId);
        $subject = $plzRow->plz . ' ' . $plzRow->ort;

        return $subject;

    }

}