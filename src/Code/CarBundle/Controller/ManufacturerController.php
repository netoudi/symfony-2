<?php

namespace Code\CarBundle\Controller;

use Code\CarBundle\Entity\Manufacturer;
use Code\CarBundle\Form\ManufacturerType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route("/manufacturer")
 */
class ManufacturerController extends Controller
{
    /**
     * @Route("/", name="manufacturer")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $repoManufacturer = $em->getRepository(Manufacturer::class);
        $manufacturers = $repoManufacturer->findAll();

        return array('manufacturers' => $manufacturers);
    }

    /**
     * @Route("/manufacturer/new", name="manufacturer.new")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Manufacturer();
        $form = $this->createForm(new ManufacturerType(), $entity);

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * @Route("/manufacturer/create", name="manufacturer.create")
     * @Template("CodeCarBundle:Manufacturer:new.html.twig")
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function createAction(Request $request)
    {
        $entity = new Manufacturer();
        $form = $this->createForm(new ManufacturerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('manufacturer'));
        }

        return array('entity' => $entity, 'form' => $form->createView());
    }
}
