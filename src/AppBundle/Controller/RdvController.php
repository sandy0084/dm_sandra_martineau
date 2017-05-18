<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Rdv;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Rdv controller.
 *
 * @Route("rdv")
 */
class RdvController extends Controller
{
    /**
     * @Route("/", name="rdv_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $rdvs = $em->getRepository('AppBundle:Rdv')->findAll();


        return $this->render('AppBundle:Rdv:index.html.twig', array(
            'rdvs' => $rdvs,
        ));
    }
    
    /**
     *
     * @Route("/new", name="rdv_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $rdv = new Rdv();

        $form = $this->createForm('AppBundle\Form\RdvType', $rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($rdv);
            $em->flush();
            return $this->redirectToRoute('rdv_show', array('id' => $rdv->getId()));
        }

        return $this->render('AppBundle:Rdv:new.html.twig', array(
            'rdv' => $rdv,
            'form' => $form->createView(),
        ));
    }


    /**
     *
     * @param Rdv $rdv The rdv entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Rdv $rdv)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('rdv_delete', array('id' => $rdv->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }
    
    /**
     *
     * @Route("/{id}", name="rdv_show")
     * @Method("GET")
     */
    public function showAction(Rdv $rdv)
    {
        $deleteForm = $this->createDeleteForm($rdv);
        return $this->render('AppBundle:Rdv:show.html.twig', array(
            'rdv' => $rdv,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     *
     * @Route("/{id}", name="rdv_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Rdv $rdv)
    {
        $form = $this->createDeleteForm($rdv);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($rdv);
            $em->flush();
        }
        return $this->redirectToRoute('rdv_index');
    }
    
    /**
     *
     * @Route("/{id}/edit", name="rdv_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Rdv $rdv)
    {
        $deleteForm = $this->createDeleteForm($rdv);
        $editForm = $this->createForm('AppBundle\Form\RdvType', $rdv);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('rdv_edit', array('id' => $rdv->getId()));
        }

        return $this->render('AppBundle:Rdv:edit.html.twig', array(
            'rdv' => $rdv,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
}