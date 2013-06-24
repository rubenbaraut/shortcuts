<?php

namespace baraut\PublicBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use baraut\PublicBundle\Entity\Program;
use baraut\PublicBundle\Form\ProgramType;

/**
 * Program controller.
 *
 */
class ProgramController extends Controller
{

    /**
     * Lists all Program entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PublicBundle:Program')->findAll();

        return $this->render('PublicBundle:Program:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Program entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity  = new Program();
        $form = $this->createForm(new ProgramType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('program_show', array('id' => $entity->getId())));
        }

        return $this->render('PublicBundle:Program:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Displays a form to create a new Program entity.
     *
     */
    public function newAction()
    {
        $entity = new Program();
        $form   = $this->createForm(new ProgramType(), $entity);

        return $this->render('PublicBundle:Program:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Program entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PublicBundle:Program')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Program entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PublicBundle:Program:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),        ));
    }

    /**
     * Displays a form to edit an existing Program entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PublicBundle:Program')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Program entity.');
        }

        $editForm = $this->createForm(new ProgramType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PublicBundle:Program:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Program entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PublicBundle:Program')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Program entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new ProgramType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('program_edit', array('id' => $id)));
        }

        return $this->render('PublicBundle:Program:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Program entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PublicBundle:Program')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Program entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('program'));
    }

    /**
     * Creates a form to delete a Program entity by id.
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
