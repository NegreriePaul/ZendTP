<?php

declare(strict_types=1);

namespace Meetup\Controller;


use Meetup\Repository\MeetupRepository;
use Meetup\Form\MeetupForm;
use Zend\Http\PhpEnvironment\Request;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

final class IndexController extends AbstractActionController
{
    /**
     * @var MeetupRepository
     */
    private $meetupRepository;

    /**
     * @var MeetupForm
     */
    private $meetupForm;

    public function __construct(MeetupRepository $meetupRepository, MeetupForm $meetupForm)
    {
        $this->meetupRepository = $meetupRepository;
        $this->meetupForm = $meetupForm;
    }

    public function indexAction()
    {
        return new ViewModel([
            'meetups' => $this->meetupRepository->findAll(),
        ]);
    }

    public function addAction()
    {
        $form = $this->meetupForm;

        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());


            if ($form->isValid()) {
                if(new \DateTimeImmutable($form->getData()['datedebut']) >
                    new \DateTimeImmutable($form->getData()['datefin'])){
                    die("Erreur ! la date de fin est antérieure à la date de début");
                }
                $this->meetupRepository->createMeetup($form->getData());
                return $this->redirect()->toRoute('meetups');
            }
        }

        $form->prepare();

        return new ViewModel([
            'form' => $form,
        ]);
    }


    public function deleteAction()
    {
        /* @var $request Request */
        $request = $this->getRequest();
        /** @var $id string */
        $id = (string)$request->getPost('id');
        if (empty($id)) {
            die("impossible de supprimer");
        }
        $this->meetupRepository->delete($id);
        return $this->redirect()->toRoute('meetups');
    }



    public function editAction()
    {
        $form = $this->meetupForm;
        $id = $this->params()->fromRoute('id');
        $meetup = $this->meetupRepository->find($id);
        $form->bind($meetup);
        /* @var $request Request */
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
               $this->meetupRepository->createMeetup($form->getData());
                return $this->redirect()->toRoute('meetups');
            }
        }


        $form->prepare();


        return new ViewModel([
            'form' => $form,
            'meetup' => $meetup,
        ]);
    }

}
