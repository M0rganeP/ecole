<?php

namespace App\Controller;

use App\Entity\AbsenceRetard;
use App\Form\AbsenceRetardType;
use App\Repository\AbsenceRetardRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/absence/retard")
 */
class AbsenceRetardController extends AbstractController
{
    /**
     * @Route("/", name="absence_retard_index", methods="GET")
     */
    public function index(AbsenceRetardRepository $absenceRetardRepository): Response
    {
        return $this->render('absence_retard/index.html.twig', ['absence_retards' => $absenceRetardRepository->findAll()]);
    }

    /**
     * @Route("/new", name="absence_retard_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $absenceRetard = new AbsenceRetard();
        $form = $this->createForm(AbsenceRetardType::class, $absenceRetard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($absenceRetard);
            $em->flush();

            return $this->redirectToRoute('absence_retard_index');
        }

        return $this->render('absence_retard/new.html.twig', [
            'absence_retard' => $absenceRetard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="absence_retard_show", methods="GET")
     */
    public function show(AbsenceRetard $absenceRetard): Response
    {
        return $this->render('absence_retard/show.html.twig', ['absence_retard' => $absenceRetard]);
    }

    /**
     * @Route("/{id}/edit", name="absence_retard_edit", methods="GET|POST")
     */
    public function edit(Request $request, AbsenceRetard $absenceRetard): Response
    {
        $form = $this->createForm(AbsenceRetardType::class, $absenceRetard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('absence_retard_index', ['id' => $absenceRetard->getId()]);
        }

        return $this->render('absence_retard/edit.html.twig', [
            'absence_retard' => $absenceRetard,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="absence_retard_delete", methods="DELETE")
     */
    public function delete(Request $request, AbsenceRetard $absenceRetard): Response
    {
        if ($this->isCsrfTokenValid('delete'.$absenceRetard->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($absenceRetard);
            $em->flush();
        }

        return $this->redirectToRoute('absence_retard_index');
    }
}
