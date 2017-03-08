<?php
/**
 * Bookmark controller.
 */

namespace AppBundle\Controller;

use AppBundle\Repository\BookmarkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Class BookmarkController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/bookmark")
 */
class BookmarkController extends Controller
{
    /**
     * Index action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/",
     *     name="bookmark_index"
     * )
     */
    public function indexAction()
    {
        $bookmarkRepository = new BookmarkRepository();
        $bookmarks = $bookmarkRepository->findAll();

        return $this->render(
            'bookmark/index.html.twig',
            ['bookmarks' => $bookmarks]
        );
    }
    
    /**
     * View action.
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/{id}",
     *     name="bookmark_view"
     * )
     */
    public function viewAction($id)
    {
        $bookmarkRepository = new BookmarkRepository();
        $bookmark = $bookmarkRepository->findOneById($id);
        dump($bookmark);
        if (!$bookmark) {
			throw $this->createNotFoundException(
				'No bookmark found for id '.$id
			);
		} else {
			return $this->render(
				'bookmark/view.html.twig',
				[
					'bookmark' => $bookmark,
					'id' => $id
				]
			);
		}
    }


}
