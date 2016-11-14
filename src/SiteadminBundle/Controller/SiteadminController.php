<?php

namespace SiteadminBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use SiteadminBundle\Entity\Siteadmin;
use SiteadminBundle\Form\SiteadminType;

/**
 * Siteadmin controller.
 *
 */
class SiteadminController extends Controller
{
    /**
     * Lists all Siteadmin entities.
     *
     */                             
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $siteadmins = $em->getRepository('SiteadminBundle:Siteadmin')->findAll();

        return $this->render('SiteadminBundle:siteadmin:index.html.twig', array(
            'siteadmins' => $siteadmins,
        ));
    }

    /**
     * Creates a new Siteadmin entity.
     *
     */
    public function newAction(Request $request)
    {
        $siteadmin = new Siteadmin();
        $form = $this->createForm('SiteadminBundle\Form\SiteadminType', $siteadmin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($siteadmin);
            $em->flush();

            return $this->redirectToRoute('siteadmin_show', array('id' => $siteadmin->getId()));
        }

        return $this->render('SiteadminBundle:siteadmin:new.html.twig', array(
            'siteadmin' => $siteadmin,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Siteadmin entity.
     *
     */
    public function showAction(Siteadmin $siteadmin)
    {
        $deleteForm = $this->createDeleteForm($siteadmin);

        return $this->render('SiteadminBundle:siteadmin:show.html.twig', array(
            'siteadmin' => $siteadmin,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Siteadmin entity.
     *
     */
    public function editAction(Request $request, Siteadmin $siteadmin)
    {
        $deleteForm = $this->createDeleteForm($siteadmin);
        $editForm = $this->createForm('SiteadminBundle\Form\SiteadminType', $siteadmin);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($siteadmin);
            $em->flush();

            return $this->redirectToRoute('siteadmin_edit', array('id' => $siteadmin->getId()));
        }

        return $this->render('SiteadminBundle:siteadmin:edit.html.twig', array(
            'siteadmin' => $siteadmin,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Siteadmin entity.
     *
     */
    public function deleteAction(Request $request, Siteadmin $siteadmin)
    {
        $form = $this->createDeleteForm($siteadmin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($siteadmin);
            $em->flush();
        }

        return $this->redirectToRoute('siteadmin_index');
    }

    /**
     * Creates a form to delete a Siteadmin entity.
     *
     * @param Siteadmin $siteadmin The Siteadmin entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Siteadmin $siteadmin)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('siteadmin_delete', array('id' => $siteadmin->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
