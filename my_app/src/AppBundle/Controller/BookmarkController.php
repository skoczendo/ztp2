<?php
/**
 * Bookmark controller.
 */

namespace AppBundle\Controller;

use AppBundle\Repository\BookmarkRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

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
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response Response
     *
     * @Route(
     *     "/",
     *     name="bookmark_index"
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="bookmark_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $bookmarks = $this->get('app.repository.bookmark')->findAll();

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
        $bookmark = $this->get('app.repository.bookmark')->findOneById($id);
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
