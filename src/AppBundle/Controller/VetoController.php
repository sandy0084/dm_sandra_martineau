<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Veto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * VetoController
 *
 * @Route("veto")
 */
class VetoController extends Controller
{
    /**
     * @Route("/", name="veto_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $vetos = $em->getRepository('AppBundle:Veto')->findAll();
        return $this->render('AppBundle:Veto:index.html.twig', array(
            'vetos' => $vetos,
        ));
    }
    /**
     * @Route("/new", name="veto_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $veto = new Veto();
        $form = $this->createForm('AppBundle\Form\VetoType', $veto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($veto);
            $em->flush();
            return $this->redirectToRoute('veto_show', array('id' => $veto->getId()));
        }
        return $this->render('AppBundle:Veto:new.html.twig', array(
            'veto' => $veto,
            'form' => $form->createView(),
        ));
    }
    /**
     * @Route("/{id}", name="veto_show")
     * @Method("GET")
     */
    public function showAction(Veto $veto)
    {
        $deleteForm = $this->createDeleteForm($veto);
        return $this->render('AppBundle:Veto:show.html.twig', array(
            'veto' => $veto,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * @Route("/{id}/edit", name="veto_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Veto $veto)
    {
        $deleteForm = $this->createDeleteForm($veto);
        $editForm = $this->createForm('AppBundle\Form\VetoType', $veto);
        $editForm->handleRequest($request);
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('veto_edit', array('id' => $veto->getId()));
        }
        return $this->render('AppBundle:Veto:edit.html.twig', array(
            'veto' => $veto,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * @Route("/{id}", name="veto_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Veto $veto)
    {
        $form = $this->createDeleteForm($veto);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($veto);
            $em->flush();
        }
        return $this->redirectToRoute('veto_index');
    }
    /**
     * @param Veto $veto The veto entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Veto $veto)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('veto_delete', array('id' => $veto->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}