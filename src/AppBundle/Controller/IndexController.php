<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Trascastro\UserBundle\Entity\User;
use Trascastro\UserBundle\Form\SetUpType;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller
{
    /**
     * @Route("/", name="app_index_index")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        if (!$this->getUser()->getName()) {
            return $this->forward('AppBundle:Index:setUp', ['username' => $this->getUser()->getUsername()]);
        }

        return $this->render(':index:index.html.twig');
    }

    /**
     * @Route("/setup/{username}", name="app_index_setUp")
     * @Security("has_role('ROLE_USER')")
     */
    public function setUpAction(Request $request, User $user)
    {
        $form = $this->createForm(SetUpType::class, $user);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->flush();
                return $this->redirectToRoute('app_index_index');
            }
        }

        return $this->render(':index:setup.html.twig', ['form' => $form->createView()]);
    }
}