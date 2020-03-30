<?php


namespace Nemundo\Process\App\Favorite\Reader;


use Nemundo\Core\Base\AbstractBase;
use Nemundo\Process\App\Favorite\Data\Favorite\FavoriteReader;
use Nemundo\Process\Content\Type\AbstractContentType;

class FavoriteUserReader extends AbstractBase
{

    /**
     * @var AbstractContentType
     */
    private $contentType;

    public function __construct(AbstractContentType $contentType)
    {
        $this->contentType = $contentType;
    }


    // getUserList(AbstractContentType $contentType)
    public function getUserList()
    {


        $userList = [];

        $favoriteReader = new FavoriteReader();
        $favoriteReader->filter->andEqual($favoriteReader->model->contentId, $this->contentType->getContentId());
        foreach ($favoriteReader->getData() as $favoriteRow) {
            $userList[] = $favoriteRow->userId;
        }

        return $userList;

    }


}