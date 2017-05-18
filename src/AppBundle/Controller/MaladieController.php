<?php
namespace AppBundle\Controller;

use AppBundle\Entity\Maladie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


/**
 * Maladie controller.
 *
 * @Route("maladie")
 */
class MaladieController extends Controller
{
    /**
     *
     * @Route("/", name="maladie_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $maladies = $em->getRepository('AppBundle:Maladie')->findAll();
        
        return $this->render('AppBundle:Maladie:index.html.twig', array(
            'maladies' => $maladies,
        ));
    }
    
    /**
     *
     * @Route("/new", name="maladie_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $maladie = new Maladie();
        
        $form = $this->createForm('AppBundle\Form\MaladieType', $maladie);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($maladie);
            $em->flush();
            return $this->redirectToRoute('maladie_show', array('id' => $maladie->getId()));
        }
        
        return $this->render('AppBundle:Maladie:new.html.twig', array(
            'maladie' => $maladie,
            'form' => $form->createView(),
        ));
    }


    /**
     * @param Maladie $maladie The maladie entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Maladie $maladie)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('maladie_delete', array('id' => $maladie->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
    
    /**
     * @Route("/{id}/edit", name="maladie_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Maladie $maladie)
    {
        $deleteForm = $this->createDeleteForm($maladie);
        $editForm = $this->createForm('AppBundle\Form\MaladieType', $maladie);
        $editForm->handleRequest($request);
        
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('maladie_edit', array('id' => $maladie->getId()));
        }
        
        return $this->render('AppBundle:Maladie:edit.html.twig', array(
            'maladie' => $maladie,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     *
     * @Route("/{id}", name="maladie_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Maladie $maladie)
    {
        $form = $this->createDeleteForm($maladie);
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($maladie);
            $em->flush();
        }
        
        return $this->redirectToRoute('maladie_index');
    }


    /**
     *
     * @Route("/{id}", name="maladie_show")
     * @Method("GET")
     */
    public function showAction(Maladie $maladie)
    {
        $deleteForm = $this->createDeleteForm($maladie);
        return $this->render('AppBundle:Maladie:show.html.twig', array(
            'maladie' => $maladie,
            'delete_form' => $deleteForm->createView(),
        ));
    }
}

