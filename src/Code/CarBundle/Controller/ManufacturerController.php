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
            $manufacturerService = $this->get('code.service.manufacturer');
            $manufacturerService->insert($entity);

            return $this->redirect($this->generateUrl('manufacturer'));
        }

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * @Route("/{id}/edit", name="manufacturer.edit")
     * @Template()
     * @param $id
     * @return array
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Manufacturer::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Manufacturer not found.');
        }

        $form = $this->createForm(new ManufacturerType(), $entity);

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * @Route("/manufacturer/{id}/update", name="manufacturer.update")
     * @Template("CodeCarBundle:Manufacturer:edit.html.twig")
     * @param Request $request
     * @param $id
     * @return array|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Manufacturer::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Manufacturer not found.');
        }

        $form = $this->createForm(new ManufacturerType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $manufacturerService = $this->get('code.service.manufacturer');
            $manufacturerService->update($entity);

            return $this->redirect($this->generateUrl('manufacturer'));
        }

        return array('entity' => $entity, 'form' => $form->createView());
    }

    /**
     * @Route("/{id}/delete", name="manufacturer.delete")
     * @param $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository(Manufacturer::class)->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Manufacturer not found.');
        }

        $em->remove($entity);
        $em->flush();

        return $this->redirect($this->generateUrl('manufacturer'));
    }
}
