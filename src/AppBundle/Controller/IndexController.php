<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Trascastro\UserBundle\Form\SetUpType;

class IndexController extends Controller
{
    /**
     * @Route("/", name="app_index_index")
     * @Security("has_role('ROLE_USER')")
     */
    public function indexAction()
    {
        $user = $this->getUser();

        if (!$user->getName()) {
            return $this->forward('AppBundle:Index:setUp');
        }

        return $this->render(':index:index.html.twig');
    }

    public function setUpAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(SetUpType::class, $user);

        if ($request->isMethod(Request::METHOD_POST)) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $m = $this->getDoctrine()->getManager();
                $m->flush();

                return $this->redirectToRoute('app_index_index');
            }
        }

        return $this->render('UserBundle:SetUp:step1.html.twig', ['form' => $form->createView()]);
    }
}