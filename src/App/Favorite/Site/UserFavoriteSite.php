<?php

namespace Nemundo\Process\App\Favorite\Site;

use Nemundo\Admin\Com\Table\AdminClickableTable;
use Nemundo\Admin\Com\Title\AdminTitle;
use Nemundo\Com\TableBuilder\TableHeader;
use Nemundo\Core\Language\LanguageCode;
use Nemundo\Dev\App\Factory\DefaultTemplateFactory;
use Nemundo\Html\Table\Th;
use Nemundo\Package\Bootstrap\Layout\BootstrapTwoColumnLayout;
use Nemundo\Package\Bootstrap\Pagination\BootstrapPagination;
use Nemundo\Package\Bootstrap\Table\BootstrapClickableTableRow;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoritePaginationReader;
use Nemundo\Process\App\Favorite\Parameter\FavoriteParameter;
use Nemundo\User\Session\UserSession;
use Nemundo\Web\Site\AbstractSite;

class UserFavoriteSite extends AbstractSite
{

    /**
     * @var UserFavoriteSite
     */
    public static $site;

    protected function loadSite()
    {

        $this->title[LanguageCode::EN] = 'My Favorite';
        $this->title[LanguageCode::DE] = 'Meine Favoriten';

        $this->url = 'my-favorite';

        new FavoriteSaveSite($this);
        new FavoriteDeleteSite($this);

        UserFavoriteSite::$site = $this;

        new UserFavoriteDeleteSite($this);

    }

    public function loadContent()
    {

        $page = (new DefaultTemplateFactory())->getDefaultTemplate();

        $title = new AdminTitle($page);
        $title->content = $this->title;

        $layout=new BootstrapTwoColumnLayout($page);

        $table = new AdminClickableTable($layout->col1);

        $header = new TableHeader($table);

        $th = new Th($header);
        $th->content[LanguageCode::EN] = 'Subject';
        $th->content[LanguageCode::DE] = 'Betreff';

        $header->addEmpty();

        $favoriteReader = new FavoritePaginationReader();
        $favoriteReader->model->loadContent();
        $favoriteReader->model->content->loadContentType();
        $favoriteReader->filter->andEqual($favoriteReader->model->userId, (new UserSession())->userId);
        $favoriteReader->addOrder($favoriteReader->model->subject);

        foreach ($favoriteReader->getData() as $favoriteRow) {

            $contentType = $favoriteRow->content->getContentType();

            $row = new BootstrapClickableTableRow($table);
            $row->addText($favoriteRow->subject);

            $site = clone(UserFavoriteDeleteSite::$site);
            $site->addParameter(new FavoriteParameter($favoriteRow->id));
            $row->addIconSite($site);

            $row->addClickableSite($contentType->getViewSite());


        }

        $pagination = new BootstrapPagination($page);
        $pagination->paginationReader = $favoriteReader;

        $page->render();

    }

}