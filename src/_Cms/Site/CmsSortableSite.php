<?php


namespace Nemundo\Process\Cms\Site;


use Nemundo\Package\JqueryUi\Sortable\AbstractSortableSite;
use Nemundo\Process\Cms\Data\Cms\CmsUpdate;

class CmsSortableSite extends AbstractSortableSite
{

    /**
     * @var CmsSortableSite
     */
    public static $site;

    protected function loadSite()
    {
        // TODO: Implement loadSite() method.
        CmsSortableSite::$site=$this;

    }


    public function loadContent()
    {

        $itemOrder = 0;
        foreach ($this->getItemOrderList() as $value) {


            $update=new CmsUpdate();
            $update->itemOrder=$itemOrder;
            $update->updateById($value);


            //foreach ($_POST['item'] as $value) {

                /*$data =  new ProjektPhaseUpdate();
                $data->itemOrder = $itemOrder;
                $data->updateById($value);*/

                $itemOrder++;


        }


        // TODO: Implement loadContent() method.
    }

}