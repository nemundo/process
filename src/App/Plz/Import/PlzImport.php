<?php


namespace Nemundo\Process\App\Plz\Import;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Core\Csv\Reader\CsvReader;
use Nemundo\Core\Debug\Debug;
use Nemundo\Model\Setup\ModelCollectionSetup;
use Nemundo\Process\App\Plz\Content\PlzContentItem;
use Nemundo\Process\App\Plz\Content\PlzContentType;
use Nemundo\Process\App\Plz\Data\PlzCollection;
use Nemundo\Process\Content\Setup\ContentTypeSetup;
use Nemundo\Project\Path\TmpPath;

class PlzImport extends AbstractBase
{

    public function import()
    {


        $setup = new ModelCollectionSetup();
        $setup->removeCollection(new PlzCollection());
        $setup->addCollection(new PlzCollection());

        $setup = new ContentTypeSetup();
        $setup->addContentType(new PlzContentType());

        // PLZ;ORT;Kanton;Longitude;Latitude

        $csvReader = new CsvReader();
        $csvReader->filename = (new TmpPath())->addPath('politische-gemeinden_v2.csv')->getFilename();
        $csvReader->utf8Encode = true;
        foreach ($csvReader->getData() as $csvRow) {

            //(new Debug())->write($csvRow->getValue('ORT'));

            $item = new PlzContentItem();
            $item->ort = $csvRow->getValue('gemeindename');
            $item->plz = $csvRow->getValue('bfsnr');
            //$item->coordinate->latitude = $csvRow->getValue('Latitude');
            //$item->coordinate->longitude = $csvRow->getValue('Longitude');
            $item->saveItem();


        }

    }

}