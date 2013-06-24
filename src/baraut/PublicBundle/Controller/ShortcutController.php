<?php

namespace baraut\PublicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use baraut\PublicBundle\Entity\Shortcut;
use baraut\PublicBundle\Form\ShortcutType;

/**
 * Shortcut controller.
 *
 */
class ShortcutController extends Controller
{

    /**
     * Lists all Shortcut entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PublicBundle:Shortcut')->findAll();

        return $this->render('PublicBundle:Shortcut:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Shortcut entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Shortcut();
        $form = $this->createForm(new ShortcutType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('shortcut_show', array('id' => $entity->getId())));
        }

        return $this->render('PublicBundle:Shortcut:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Shortcut entity.
     *
     */
    public function newAction()
    {
        $entity = new Shortcut();
        $form   = $this->createForm(new ShortcutType(), $entity);

        return $this->render('PublicBundle:Shortcut:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Shortcut entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PublicBundle:Shortcut')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Shortcut entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PublicBundle:Shortcut:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Shortcut entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PublicBundle:Shortcut')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Shortcut entity.');
        }

        $editForm = $this->createForm(new ShortcutType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PublicBundle:Shortcut:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Shortcut entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PublicBundle:Shortcut')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Shortcut entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ShortcutType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('shortcut_edit', array('id' => $id)));
        }

        return $this->render('PublicBundle:Shortcut:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Shortcut entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PublicBundle:Shortcut')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Shortcut entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('shortcut'));
    }

    /**
     * Creates a form to delete a Shortcut entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
