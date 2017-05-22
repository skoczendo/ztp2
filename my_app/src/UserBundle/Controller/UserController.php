<?php
// src/UserBundle/Controller/UserController.php
/**
 * User controller.
 */
namespace UserBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Form\UserType;

/**
 * Class UserController.
 *
 * @package UserBundle\Controller
 *
 * @Route("/user")
 */
class UserController extends Controller
{
    /**
     * Index action.
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/",
     *     name="user_index",
     * )
     * @Method("GET")
     */
    public function indexAction()
    {
        $userManager = $this->get('fos_user.user_manager');
        $users = $userManager->findUsers();
        return $this->render(
            'user/index.html.twig',
            ['users' => $users]
        );
    }

    /**
     * Edit action.
     *
     *
     * @return \Symfony\Component\HttpFoundation\Response HTTP Response
     *
     * @Route(
     *     "/{id}/edit",
     *     name="user_edit",
     * )
     * @Method("GET")
     */
    public function editAction(Request $request, User $user)
    {
        /*$userManager = $this->get('fos_user.user_manager');
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles($user['role']);
            $userManager->updateUser($user);
            $this->addFlash('success', 'message.created_successfully');

            return $this->redirectToRoute('tag_index');
        }

        return $this->render(
            'user/index.html.twig',
            ['users' => $user]
        );
        */

    }
}