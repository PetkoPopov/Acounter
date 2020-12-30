<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Acounter;
use AppBundle\Entity\Work;
use AppBundle\Form\AcounterType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Repository\AcounterRepository;

/**
 * Acounter controller.
 *
 * @Route("acounter")
 */
class AcounterController extends Controller
{
    /**
     * Lists all acounter entities.
     *
     * @Route("/", name="acounter_index" , methods={"GET"})
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $acounters = $em->getRepository('AppBundle:Acounter')->findAll();
//var_dump($acounters);die;
        return $this->render('acounter/index.html.twig', array(
            'acounters' => $acounters,
        ));
    }

    /**
     * Creates a new acounter entity.
     *
     * @Route("/new", name="acounter_new" , methods={"GET" , "POST"})
     *
     */
    public function newAction(Request $request)
    {

        $work=$this->setType($request);
//        dump($work);die;
            $acounter = new Acounter();

            $name = $request->query->get('setName');

            if (isset($name)) {

                $acounter->setObjectName($name);

            }

            $acounter->setNotice("talk");
            $acounter->setItemBuyed1("boots");
            $acounter->setItemBuyed5("test");
            $acounter->setMoneyPayed(rand(1, 100));
            $acounter->setMoneyRecived(rand(1, 100));
            $date = new \DateTime("now");
            if (!empty($request->query->get('setWork'))) {
                $type = $request->query->get('setWork');
                $acounter->setTypeWork($type);
            }else{

            }
            $acounter->setDateWork($date);


            $form = $this->createForm(AcounterType::class, $acounter);


            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $acounter->setType($work);
                $em = $this->getDoctrine()->getManager();
                $em->persist($acounter);
                $em->flush();
//            $acounter->getType()->setTypeWork("test");


                return $this->redirectToRoute('acounter_show', array('id' => $acounter->getId()));
            }

            return $this->render('acounter/new.html.twig', array(
                'acounter' => $acounter,
                'form' => $form->createView(),
            ));
        }

    /**
     * Finds and displays a acounter entity.
     *
     * @Route("/{id}", name="acounter_show" , methods={"GET"})
     *
     */
    public function showAction(Acounter $acounter)
    {
        $deleteForm = $this->createDeleteForm($acounter);

        return $this->render('acounter/show.html.twig', array(
            'acounter' => $acounter,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing acounter entity.
     *
     * @Route("/{id}/edit", name="acounter_edit" , methods={"GET" , "POST"})
     *
     */
    public function editAction(Request $request, Acounter $acounter)
    {

        $deleteForm = $this->createDeleteForm($acounter);
        $editForm = $this->createForm('AppBundle\Form\AcounterType', $acounter);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('acounter_edit', array('id' => $acounter->getId()));
        }

        return $this->render('acounter/edit.html.twig', array(
            'acounter' => $acounter,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }


    /**
     * Deletes a acounter entity.
     *
     * @Route("/{id}", name="acounter_delete" , methods={"DELETE"})
     *
     */
    public function deleteAction(Request $request, Acounter $acounter)
    {
        $form = $this->createDeleteForm($acounter);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($acounter);
            $em->flush();
        }

        return $this->redirectToRoute('acounter_index');
    }

    /**
     * Creates a form to delete a acounter entity.
     *
     * @param Acounter $acounter The acounter entity
     *
     * @return \Symfony\Component\Form\FormInterface The form
     */
    private function createDeleteForm(Acounter $acounter)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('acounter_delete', array('id' => $acounter->getId())))
            ->setMethod('DELETE')
            ->getForm();
    }

    /**
     * @Route("/allMoneyForObject/{id}" , name="all_money_for_object" , methods={"GET" , "POST"})
     *
     *
     */
    public function allMoneyForObject($id)
    {

        $em = $this->getDoctrine()->getManager();
        $allForObject = $em->getRepository('AppBundle:Acounter');
        $nameHelp = $allForObject->find($id);
        $name = $nameHelp->getObjectName();
        $allMoney = $allForObject->findBy(['objectName' => $name]);
        $summ = 0;

        foreach ($allMoney as $money) {
            $summ += $money->getMoneyPayed();

        }

        return $this->render("allMoneyForObject.html.twig", ["sum" => $summ]);
    }

    /**
     * @Route("allMoney" , name="all_money" , methods={"GET" , "POST"})
     * @return Response|null
     */
    public function allMoney()
    {
        $em = $this->getDoctrine()->getManager();
        $allAcounters = $em->getRepository('AppBundle:Acounter')->findAll();
        $summ = 0;
        foreach ($allAcounters as $acounter) {
            $summ += $acounter->getMoneyPayed();

        }

        return $this->render("allMoneyTillNow.html.twig", ["allMoneyPayed" => $summ]);
    }

    /**
     * @Route("/items1ForObject/{id}" , name="items1_for_object" ,methods={"GET"})
     *
     * @return Response
     */
    public function items1ForObject($id)
    {
        $arr = $this->helperItems(1, $id);
        return $this->render("allIemsForObject.html.twig",
            $arr);
    }

    /**
     * @Route("/items2ForObject/{id}" , name="items2_for_object" ,methods={"GET"})
     *
     * @return Response
     */
    public function items2ForObject($id)
    {
        $arr = $this->helperItems(2, $id);
        return $this->render("allIemsForObject.html.twig",
            $arr);

    }

    /**
     * @Route("/items3ForObject/{id}" , name="items3_for_object" ,methods={"GET"})
     *
     * @return Response
     */
    public function items3ForObject($id)
    {
        $arr = $this->helperItems(3, $id);
        return $this->render("allIemsForObject.html.twig",
            $arr);
    }

    /**
     * @Route("/items4ForObject/{id}" , name="items4_for_object" ,methods={"GET"})
     *
     * @return Response
     */
    public function items4ForObject($id)
    {
        $arr = $this->helperItems(4, $id);
        return $this->render("allIemsForObject.html.twig",
            $arr);
    }

    /**
     * @Route("/items5ForObject/{id}" , name="items5_for_object" ,methods={"GET"})
     *
     * @return Response
     */
    public function items5ForObject($id)
    {
        $arr = $this->helperItems(5, $id);
        return $this->render("allIemsForObject.html.twig",
            $arr);
    }

    private function helperItems(int $number, $id)
    {

        $em = $this->getDoctrine()->getManager();
        $allForObject = $em->getRepository('AppBundle:Acounter');
        $ourObject = $allForObject->find($id);
        $nameObject = $ourObject->getObjectName();
        $allByName = $allForObject->findBy(['objectName' => $nameObject]);
        $counter = 0;
        $name = "getItemBuyed" . $number;
        $item = $ourObject->{$name}();
        foreach ($allByName as $obj) {
            if ($item == $obj->getItemBuyed1()) {
                $counter++;
            }
            if ($item == $obj->getItemBuyed2()) {
                $counter++;
            }
            if ($item == $obj->getItemBuyed3()) {
                $counter++;
            }
            if ($item == $obj->getItemBuyed4()) {
                $counter++;
            }
            if ($item == $obj->getItemBuyed5()) {
                $counter++;
            }
        }
        $arr = ["allItems" => $counter,
            "objectName" => $nameObject,
            "item" => $item,
            "object" => $ourObject
        ];
        return $arr;
    }

    /**
     * @Route("/allItems/{items}", name="all_items" , methods={"GET" , "POST"})
     *
     * @return Response
     */
    public function allItems($items)
    {

        $em = $this->getDoctrine()->getManager();
        $allObjects = $em->getRepository('AppBundle:Acounter');
        $counter = 0;
        $allObjItemName[] = $allObjects->findBy(["itemBuyed1" => $items]);
        $allObjItemName[] = $allObjects->findBy(["itemBuyed2" => $items]);
        $allObjItemName[] = $allObjects->findBy(["itemBuyed3" => $items]);
        $allObjItemName[] = $allObjects->findBy(["itemBuyed4" => $items]);
        $allObjItemName[] = $allObjects->findBy(["itemBuyed5" => $items]);
        foreach ($allObjItemName as $itemName) {
            $counter += count($itemName);
        }

        return $this->render("allIemsEver.html.twig",
            ["allItems" => $counter,
                "items" => $items,

            ]);

    }

    /**
     * @Route("/allForObject/{name}" , name="all_for_object" , methods={"GET" , "POST"})
     */
    public function allForObject($name)
    {
        $em = $this->getDoctrine()->getManager();
        $all = $em->getRepository('AppBundle:Acounter');
        $allObjectsNames = $all->findBy(['objectName' => $name]);

        return $this->render('allForObject.html.twig', [
            "allReccords" => $allObjectsNames,
            "objectName" => $name
        ]);
    }

    /**
     * @Route("/workThatDate/{date}" , name="work_that_date")
     */
    public function workThatDate($date)
    {
        $newDate = new \DateTime($date);
        $em = $this->getDoctrine()->getManager();
        $allAcounters = $em->getRepository('AppBundle:Acounter');
        $thatDate = $allAcounters->findBy(['dateWork' => $newDate,]);

        return $this->render("all_that_date.html.twig", [
            "allAcountersThatDate" => $thatDate,
            "date" => $date,

        ]);
    }

    /**
     * @Route("/all_notice/{id}" , name="all_notice_for_object" , methods={"GET" , "POST"})
     */
    public function allNoticeForObject($id)
    {
        $em = $this->getDoctrine()->getManager();
        $all = $em->getRepository('AppBundle:Acounter');
        $ourObj = $all->find($id);
        $name = $ourObj->getObjectName();
        $allNotice = $all->findBy(['objectName' => $name]);//масив с обекти

//    uksort($allNotice, function($a,$b )use ($allNotice){
//        var_dump($allNotice[$a]->getDateWork());
//        echo'<hr/>';
//
//    });

        return $this->render('allNoticeForPbject.html.twig', ['allNotice' => $allNotice]);


    }

    /**
     *
     * @Route("/setNew/{name}" ,  name="acounter_set_new" , methods={"GET"})
     *
     * @var Acounter
     */
    public function setNewAction($name)
    {

        $em = $this->getDoctrine()->getManager();
        $allAcounters = $em->getRepository('AppBundle:Acounter')->findAll();


        $allForPrint = [];
        foreach ($allAcounters as $ac) {
            if (!in_array($ac->getObjectName(), $allForPrint)) {
                $allForPrint[] = $ac->getObjectName();
            }
        }

        $emWorks=$this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Work')
            ->findAll();
        $allWorks=[];
        foreach($emWorks as $w){
            if(!in_array($w->getTypeWork(),$allWorks)){
                $allWork[]=$w->getTypeWork();

            }
        }
        $list=$this->listAllItems();
 return $this->render("acounter/setNew.html.twig",[
     "allAcounters"=>$allForPrint,
     "allWorks"=>$allWork,
     "items"=>$list

 ]);
        }

private function setType(Request $request){

    if (!empty($request->query->get('setWork'))) {
        $work = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Work')
            ->findOneBy(["typeWork" => $request->query->get("setWork")]);

        if ($work == null) {
            $work = new Work();
            $work->setTypeWork($request->$request->query->get("setWork"));
            $emWork = $this
                ->getDoctrine()
                ->getManager();
            $emWork->persist($work);
            $emWork->flush();

        }
        return $work = $this
            ->getDoctrine()
            ->getManager()
            ->getRepository('AppBundle:Work')
            ->findOneBy(["typeWork" => $request->query->get("setWork")]);

    }else{
        return null;
    }
}

    /**
     * @Route("listAllItems" , name="list_all_items")
     * @return array
     */

public function listAllItems(){
$allAcounters=$this->getDoctrine()
->getManager()
->getRepository('AppBundle:Acounter')
->findAll();
$allItems=[];
foreach($allAcounters as $ac){
    for($i=1;$i<=5;$i++){
        $h="getItemBuyed".$i;
        if(!in_array($ac->$h(),$allItems)){
            $allItems[]=$ac->$h();
        }
    }

}
return $allItems;


}


}
