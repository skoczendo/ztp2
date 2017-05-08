<?php
// src/UserBundle/Controller/UserController.php
/**
 * User controller.
 */
namespace UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

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
}