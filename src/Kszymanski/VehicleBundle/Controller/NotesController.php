<?php

namespace Kszymanski\VehicleBundle\Controller;

use Doctrine\ORM\EntityRepository;
use Kszymanski\VehicleBundle\Entity\Make;
use Kszymanski\VehicleBundle\Entity\Model;
use Kszymanski\VehicleBundle\Entity\Note;
use Kszymanski\VehicleBundle\Form\NoteAssignType;
use Kszymanski\VehicleBundle\Form\NoteType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class NotesController extends Controller
{
    /**
     * @Route("/")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'notes' => []
        ];
    }

    /**
     * @Route("/tree", name="tree")
     * @Template()
     *
     * @return array
     */
    public function treeAction()
    {
        return [
            'makes' => $this->getDoctrine()->getRepository("KszymanskiVehicleBundle:Make")->findAll()
        ];
    }

    /**
     * @Route("/notes/{hash}")
     * @Template()
     *
     * @param $hash
     * @return array
     */
    public function modelNotesAction($hash)
    {
        list($makeName, $modelName) = explode(',', $hash);

        $make = $this->getDoctrine()->getRepository("KszymanskiVehicleBundle:Make")->findOneByName($makeName);
        $model = $this->getDoctrine()->getRepository("KszymanskiVehicleBundle:Model")->findOneBy([
            "name" => $modelName,
            "make" => $make,
        ]);

        return [
            'notes' => $model->getNotes(),
            'make' => $make,
            'model' => $model,
        ];
    }

    /**
     * @Route("/note/new/{make}/{model}", name="new_note")
     * @Template("KszymanskiVehicleBundle:Notes:noteForm.html.twig")
     *
     * @param Make $make
     * @param Model $model
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function newNoteAction(Make $make, Model $model, Request $request)
    {
        $note = new Note();
        $form = $this->createForm(new NoteType(), $note, [
            'action' => $this->generateUrl('new_note', ['make' => $make->getId(), 'model' => $model->getId()]),
            'attr' => ['id' => 'form'],
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $note->addModel($model);

            $this->getDoctrine()->getManager()->persist($note);
            $this->getDoctrine()->getManager()->flush();

            return $this->render('KszymanskiVehicleBundle:Notes:formResult.html.twig', ['msg' => 'Notatka dodana.']);
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/note/edit/{note}", name="edit_note")
     * @Template("KszymanskiVehicleBundle:Notes:noteForm.html.twig")
     *
     * @param Note $note
     * @param Request $request
     * @return array|\Symfony\Component\HttpFoundation\Response
     */
    public function editNoteAction(Note $note, Request $request)
    {
        $form = $this->createForm(new NoteType(), $note, [
            'action' => $this->generateUrl('edit_note', ['note' => $note->getId()]),
            'attr' => ['id' => 'form'],
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $this->getDoctrine()->getManager()->persist($note);
            $this->getDoctrine()->getManager()->flush();

            return $this->render('KszymanskiVehicleBundle:Notes:formResult.html.twig', ['msg' => 'Notatka została zapisana.']);
        }

        return [
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/note/delete/{note}/{model}", name="delete_note")
     * @Template()
     *
     * @param Note $note
     * @param Model $model
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function deleteNoteAction(Note $note, Model $model)
    {
        $note->removeModel($model);
        if ($note->getModels()->isEmpty()) {
            $this->getDoctrine()->getManager()->remove($note);
        }
        else {
            $this->getDoctrine()->getManager()->persist($model);
        }
        $this->getDoctrine()->getManager()->flush();

        return $this->render('KszymanskiVehicleBundle:Notes:formResult.html.twig', ['msg' => 'Notatka została usunięta.']);
    }

    /**
     * @Route("/note/assign/{note}", name="assign_note")
     * @Template("KszymanskiVehicleBundle:Notes:noteForm.html.twig")
     *
     * @param Note $note
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function assignNoteAction(Note $note, Request $request)
    {
        $form = $this->createForm(new NoteAssignType(), null, [
            'action' => $this->generateUrl('assign_note', ['note' => $note->getId()]),
            'attr' => ['id' => 'form'],
        ]);

        $form->handleRequest($request);

        if ($form->isValid()) {
            $data = $form->getData()["models"];

            foreach ($data as $model) {
                if (!$note->getModels()->contains($model)) {
                    $note->addModel($model);
                }
            }

            $this->getDoctrine()->getManager()->persist($note);
            $this->getDoctrine()->getManager()->flush();

            return $this->render('KszymanskiVehicleBundle:Notes:formResult.html.twig', ['msg' => 'Notatka została przypisana.']);
        }

        return [
            'form' => $form->createView(),
        ];
    }
}
