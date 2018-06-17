<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Market;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Market controller.
 *
 * @Route("market")
 */
class MarketController extends Controller
{
    /**
     * Lists all market entities.
     *
     * @Route("/", name="market_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $markets = $em->getRepository('AppBundle:Market')->findAll();

        return $this->render('market/index.html.twig', array(
            'markets' => $markets,
        ));
    }

    /**
     * Creates a new market entity.
     *
     * @Route("/new", name="market_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $market = new Market();
        $form = $this->createForm('AppBundle\Form\MarketType', $market);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($market);
            $em->flush();

            return $this->redirectToRoute('market_show', array('id' => $market->getId()));
        }

        return $this->render('market/new.html.twig', array(
            'market' => $market,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a market entity.
     *
     * @Route("/{id}", name="market_show")
     * @Method("GET")
     */
    public function showAction(Market $market)
    {
        $deleteForm = $this->createDeleteForm($market);
        
        return $this->render('market/show.html.twig', array(
            'market' => $market,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing market entity.
     *
     * @Route("/{id}/edit", name="market_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Market $market)
    {
        $deleteForm = $this->createDeleteForm($market);
        $editForm = $this->createForm('AppBundle\Form\MarketType', $market);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('market_edit', array('id' => $market->getId()));
        }

        return $this->render('market/edit.html.twig', array(
            'market' => $market,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a market entity.
     *
     * @Route("/{id}", name="market_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Market $market)
    {
        $form = $this->createDeleteForm($market);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($market);
            $em->flush();
        }

        return $this->redirectToRoute('market_index');
    }

    /**
     * Creates a form to delete a market entity.
     *
     * @param Market $market The market entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Market $market)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('market_delete', array('id' => $market->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
