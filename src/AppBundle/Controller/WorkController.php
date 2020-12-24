<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Work;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;



/**
 *@Route("/work")
 *
 */
 class WorkController extends Controller
{
    /**
     * @Route("/new" , name="new_type" ,methods={"GET" , "POST"})
     */
    public function newAction()
    {
        return $this->render('AppBundle:Work:new.html.twig', array(
            // ...
        ));
    }

    /**
     *
     * @Route("/showAll", name="show_all" , methods={"GET"})
     *
     */
    public function showAllAction()
    {
   $em=
            $this->getDoctrine()->getManager();
        $allAcounters=$em->getRepository(
            'AppBundle:Acounter'
        )->findAll();

        $allForPrint=[];
foreach($allAcounters as $ac) {
    if (!in_array($ac->getObjectName(), $allForPrint)) {
        $allForPrint[] = $ac->getObjectName();
    }
}

        return $this->render('Work/show_all.html.twig', array(
            "all"=>$allForPrint
        ));
    }

     /**
      * @Route("/createNew" , name="create_new" , methods={"GET"})
      *
      * @param Request
      */
    public function createNew(Request $request){

        echo "<pre>";
        var_dump($request->all());
        echo "</pre>";
        die;
$n=$request->getQueryString();
$name=explode("=", $n);
$work=new Work();
$work->setTypeWork($name[1]);


    }

}
