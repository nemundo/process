<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Com\TableBuilder\TableRow;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Favorite\Com\FavoriteContainer;
use Nemundo\Process\App\Favorite\Content\FavoriteContentType;
use Nemundo\Process\Content\Data\Content\ContentReader;
use Nemundo\User\Type\UserSessionType;
use Nemundo\Web\Site\AbstractSite;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteReader;
use Nemundo\Process\App\Favorite\Parameter\FavoriteParameter;

class FavoriteSite extends AbstractSite
{
    protected function loadSite()
    {
        $this->title = 'Favorite';
        $this->url = 'my-favorite';

        new FavoriteSaveSite($this);
        new FavoriteDeleteSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $title = new AdminTitle($page);
        $title->content = $this->title;




        //new FavoriteContainer($page);


        $table = new AdminClickableTable($page);

        $header = new TableHeader($table);
        $header->addText('Content Type');
        $header->addText('Subject');
        $header->addEmpty();

        $reader = new ContentReader();
        $reader->model->loadContentType();
        $reader->filter->andEqual($reader->model->contentTypeId,(new FavoriteContentType())->typeId);
        $reader->filter->andEqual($reader->model->userId, (new UserSessionType())->userId);

        foreach ($reader->getData() as $contentRow ) {

            $contentType= $contentRow->getContentType();

            $row=new BootstrapClickableTableRow($table);
            $row->addText($contentType->getSubject());


            // contentId =



            $parentContentType=$contentType->getParentContentType();
            $row->addText($parentContentType->getSubject());

            $row->addClickableSite($parentContentType->getViewSite());


        }









        // löschen


        /*
        $favoriteReader = new FavoriteReader();
        $favoriteReader->model->loadContent();
        $favoriteReader->model->content->loadContentType();
        //$favoriteReader->model->loadUser();
        $favoriteReader->filter->andEqual($favoriteReader->model->userId, (new UserSessionType())->userId);

        foreach ($favoriteReader->getData() as $favoriteRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($favoriteRow->content->contentType->contentType);

            $row->addText($favoriteRow->content->subject);


            //$row->addText($favoriteRow->dataId);

            $contentType = $favoriteRow->content->contentType->getContentType();  // contentType->getContentTypeClassObject();

            //$subject = $contentType->getSubject($favoriteRow->contentId);  //$favoriteRow->dataId);

            /*if ($favoriteRow->dataId !== '0') {
                $subject = $contentType->getSubject($favoriteRow->dataId);
            }*/
            //$row->addText($subject);

            //$row->addText($favoriteRow->user->displayName);

        /*    $site = clone(FavoriteDeleteSite::$site);
            $site->addParameter(new FavoriteParameter($favoriteRow->id));
            $row->addIconSite($site);

            $row->addClickableSite($contentType->getViewSite($favoriteRow->contentId));  //$favoriteRow->dataId));


        }*/

        $page->render();

    }

}