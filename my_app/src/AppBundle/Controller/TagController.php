<?php
/**
 * Tag controller.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Tag;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\TagType;

/**
 * Class TagController.
 *
 * @package AppBundle\Controller
 *
 * @Route("/tag")
 */
class TagController extends Controller
{
    /**
     * Index action.
     *
     * @param integer $page Current page number
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     defaults={"page": 1},
     *     name="tag_index",
     * )
     * @Route(
     *     "/page/{page}",
     *     requirements={"page": "[1-9]\d*"},
     *     name="tag_index_paginated",
     * )
     * @Method("GET")
     */
    public function indexAction($page)
    {
        $tags = $this->get('app.repository.tag')->findAllPaginated($page);

        return $this->render(
            'tag/index.html.twig',
            ['tags' => $tags]
        );
    }

    /**
     * View action.
     *
     * @param Tag $tag Tag entity
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/view/{id}",
     *     requirements={"id": "[1-9]\d*"},
     *     name="tag_view",
     * )
     * @Method("GET")
     */
    public function viewAction(Tag $tag)
    {
        return $this->render(
            'tag/view.html.twig',
            ['tag' => $tag]
        );

        $tag = $this->get('app.repository.tag')->findOneById($id);
        if (!$tag) {
			throw $this->createNotFoundException(
				'No tag found for id '.$id
			);
		} else {
			return $this->render(
				'tag/view.html.twig',
				[
					'tag' => $tag,
					'id' => $id
				]
			);
		}
    }

    /**
     * Add action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/add",
     *     name="tag_add",
     * )
     * @Method({"GET", "POST"})
     */
    public function addAction(Request $request)
    {
        $tag = new Tag();
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.tag')->save($tag);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/add.html.twig',
            [
                'tag' => $tag,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Edit action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     name="tag_edit",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tag $tag){
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.tag')->save($tag);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/edit.html.twig',
            [
                'tag' => $tag,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * Delete action.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request HTTP Request
     *
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/delete",
     *     name="tag_delete",
     *     requirements={"page": "[1-9]\d*"},
     * )
     * @Method({"GET", "POST"})
     */
    public function deleteAction(Request $request,Tag $tag){
        $form = $this->createForm(TagType::class, $tag);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->get('app.repository.tag')->delete($tag);
            $this->addFlash('success', 'message.deleted_successfully');

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'tag/delete.html.twig',
            [
                'tag' => $tag,
                'form' => $form->createView(),
            ]
        );
    }

}


