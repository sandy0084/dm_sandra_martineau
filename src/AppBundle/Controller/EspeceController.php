<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Espece;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Espece controller.
 *
 * @Route("espece")
 */
class EspeceController extends Controller
{
    /**
     *
     * @Route("/", name="espece_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $especes = $em->getRepository('AppBundle:Espece')->findAll();
        return $this->render('AppBundle:Espece:index.html.twig', array(
            'especes' => $especes,
        ));
    }
    
    /**
     *
     * @Route("/new", name="espece_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $espece = new Espece();
        $form = $this->createForm('AppBundle\Form\EspeceType', $espece);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($espece);
            $em->flush();
            return $this->redirectToRoute('espece_show', array(
                'id' => $espece->getId()
            ));
        }
        
        return $this->render('AppBundle:Espece:new.html.twig', array(
            'espece' => $espece,
            'form' => $form->createView(),
        ));
    }
    
    /**
     *
     * @Route("/{id}", name="espece_show")
     * @Method("GET")
     */
    public function showAction(Espece $espece)
    {
        $deleteForm = $this->createDeleteForm($espece);
        return $this->render('AppBundle:Espece:show.html.twig', array(
            'espece' => $espece,
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     *
     * @Route("/{id}/edit", name="espece_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Espece $espece)
    {
        $deleteForm = $this->createDeleteForm($espece);
        $editForm = $this->createForm('AppBundle\Form\EspeceType', $espece);
        $editForm->handleRequest($request);
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('espece_edit', array('id' => $espece->getId()));
        }
        
        return $this->render('AppBundle:Espece:edit.html.twig', array(
            'espece' => $espece,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    
    /**
     *
     * @Route("/{id}", name="espece_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Espece $espece)
    {
        $form = $this->createDeleteForm($espece);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($espece);
            $em->flush();
        }
        return $this->redirectToRoute('espece_index');
    }
    
    /**
     *
     * @param Espece $espece The espece entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Espece $espece)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('espece_delete', array('id' => $espece->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}