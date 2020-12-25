<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Work;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Work controller.
 *
 * @Route("work")
 */
class WorkController extends Controller
{
    /**
     * Lists all work entities.
     *
     * @Route("/", name="work_index" , methods={"GET"})
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $works = $em->getRepository('AppBundle:Work')->findAll();

        return $this->render('work/index.html.twig', array(
            'works' => $works,
        ));
    }

    /**
     * Creates a new work entity.
     *
     * @Route("/new", name="work_new" , methods={"GET" , "POST"})
     *
     */
    public function newAction(Request $request)
    {
        $queryString=$request->getQueryString();
        $typeWork=explode('=',$queryString);
        $work = new Work();
        if( array_key_exists(1,$typeWork)){
            $work->setTypeWork($typeWork[1]);
        }

        $form = $this->createForm('AppBundle\Form\WorkType', $work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($work);
            $em->flush();

            return $this->redirectToRoute('work_show', array('id' => $work->getId()));
        }

        return $this->render('work/new.html.twig', array(
            'work' => $work,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a work entity.
     *
     * @Route("/{id}", name="work_show" , methods={"GET"})
     *
     */
    public function showAction(Work $work)
    {
        $deleteForm = $this->createDeleteForm($work);

        return $this->render('work/show.html.twig', array(
            'work' => $work,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing work entity.
     *
     * @Route("/{id}/edit", name="work_edit" , methods={"GET", "POST"})
     *
     */
    public function editAction(Request $request, Work $work)
    {
        $deleteForm = $this->createDeleteForm($work);
        $editForm = $this->createForm('AppBundle\Form\WorkType', $work);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('work_edit', array('id' => $work->getId()));
        }

        return $this->render('work/edit.html.twig', array(
            'work' => $work,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a work entity.
     *
     * @Route("/{id}", name="work_delete" , methods={"DELETE"})
     *
     */
    public function deleteAction(Request $request, Work $work)
    {
        $form = $this->createDeleteForm($work);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($work);
            $em->flush();
        }

        return $this->redirectToRoute('work_index');
    }

    /**
     * Creates a form to delete a work entity.
     *
     * @param Work $work The work entity
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(Work $work)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('work_delete', array('id' => $work->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    /**
     * @Route("/makeNew/{id}" , name="work_set_new" , methods={"GET"})
     */
    public function makeNewAction($id){

        $em=$this->getDoctrine()->getManager();
        $all=$em->getRepository(Work::class)
            ->findAll();
        $allWorks=[];
        foreach ($all as $w){
            if(!in_array($w->getTypeWork(),$allWorks)){
                $allWorks[]=$w->getTypeWork();
            }
        }



        return $this->render('work/setWork.html.twig',['all'=>$allWorks]);
    }
}
