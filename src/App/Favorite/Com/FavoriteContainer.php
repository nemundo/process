<?php


namespace Nemundo\Process\App\Favorite\Com;


use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Html\Container\AbstractHtmlContainer;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteReader;
use Nemundo\Process\App\Favorite\Parameter\FavoriteParameter;
use Nemundo\Process\App\Favorite\Site\FavoriteDeleteSite;
use Nemundo\User\Session\UserSession;

class FavoriteContainer extends AbstractHtmlContainer
{

    public function getContent()
    {

        $table = new AdminClickableTable($this);

        $header = new TableHeader($table);
        $header->addText('Content Type');
        $header->addText('Subject');
        $header->addEmpty();

        // löschen

        $favoriteReader = new FavoriteReader();
        $favoriteReader->model->loadContent();
        $favoriteReader->model->content->loadContentType();
        $favoriteReader->filter->andEqual($favoriteReader->model->userId, (new UserSession())->userId);
        $favoriteReader->addOrder($favoriteReader->model->content->subject);

        foreach ($favoriteReader->getData() as $favoriteRow) {

            $row = new BootstrapClickableTableRow($table);
            $row->addText($favoriteRow->content->contentType->contentType);
            $row->addText($favoriteRow->content->subject);

            $contentType = $favoriteRow->content->contentType->getContentType();

            $site = clone(FavoriteDeleteSite::$site);
            $site->addParameter(new FavoriteParameter($favoriteRow->id));
            $row->addIconSite($site);

            $row->addClickableSite($contentType->getViewSite($favoriteRow->contentId));


        }


        return parent::getContent();
    }

}