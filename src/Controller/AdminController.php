<?php

namespace App\Controller;

use App\Entity\Devices;
use App\Entity\Map;
use App\Entity\Okna;
use App\Entity\User;
use App\Form\AddUserType;
use App\Form\DevicesType;
use App\Form\MapType;
use App\Form\WindowType;
use App\Repository\DevicesRepository;
use App\Repository\MapRepository;
use App\Repository\OknaRepository;
use App\Repository\UserRepository;
use App\Services\AdminAjax;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    private function checkAdminRole()
    {
        if (!$this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('appindex');
        }
    }
    
    public function ajax(AdminAjax $adminAjax, Request $request)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $data = json_decode($request->getContent(), true);
        $adminAjax->setData($data['request'], $data['data']);

        return $this->json($adminAjax->getData(), $adminAjax->getStatus());
    }
    
    public function users(UserRepository $userRepository)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $users = $userRepository->findAll();

        return $this->render('admin/users.html.twig', compact('users'));
    }

    public function addUser(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;
        
        $form = $this->createForm(AddUserType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $data = $form->getData();

            $user = new User();
            $user->setUsername($data['username']);
            $user->setPassword(
                $passwordEncoder->encodePassword($user, $data['password'])
            );

            $roles = [];
            if ($data['ROLE_CONTROL'] !== false)
                $roles[] = 'ROLE_CONTROL';

            if ($data['ROLE_ADMIN'] !== false)
                $roles[] = 'ROLE_ADMIN';

            $user->setRoles($roles);
            $em = $this->getDoctrine()->getManager();

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', 'Pomyślnie utworzono użytkownika ' . $data['username']);

            return $this->redirect($this->generateUrl('admin.users'));
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Dodaj nowego użytkownika'
        ]);
    }

    public function deleteUser($id, UserRepository $userRepository)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $user = $userRepository->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($user);
        $em->flush();

        return $this->redirect($this->generateUrl('admin.users'));
    }

    public function devices(DevicesRepository $devicesRepository)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $devices = $devicesRepository->findAll();

        return $this->render('admin/devices.html.twig', compact('devices'));
    }

    public function addDevice(Request $request)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;
        
        $devices = new Devices();

        $form = $this->createForm(DevicesType::class, $devices);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($devices);
            $em->flush();

            $this->addFlash('success', 'Pomyślnie dodano urządzenie o ID ' . $devices->getId());

            return $this->redirectToRoute('admin.devices');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Dodaj nowe urządzenie'
        ]);
    }

    public function deleteDevice($id, DevicesRepository $devicesRepository)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $device = $devicesRepository->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($device);
        $em->flush();

        return $this->redirect($this->generateUrl('admin.devices'));
    }

    public function configurate(MapRepository $mapRepository, OknaRepository $oknaRepository)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $maps = $mapRepository->findAll();

        $windows = $oknaRepository->findAll();

        return $this->render('admin/configurate.html.twig', compact('maps', 'windows'));
    }

    public function addMapConfigurate(Request $request)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;
        
        $map = new Map();

        $form = $this->createForm(MapType::class, $map);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();

            $em->persist($map);
            $em->flush();

            $this->addFlash('success', 'Pomyślnie dodano nową mapę.');

            return $this->redirectToRoute('admin.configurate');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Dodaj nową mapę'
        ]);
    }

    public function deleteMapConfigurate($id, MapRepository $mapRepository)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $map = $mapRepository->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($map);
        $em->flush();

        return $this->redirect($this->generateUrl('admin.configurate'));
    }

    public function addWindowConfigurate(Request $request)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;
        
        $windows = new Okna();

        $form = $this->createForm(WindowType::class, $windows);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $data = $form->getData();

            $device = $em->getRepository(Devices::class)->find($data->getDeviceId());

            $controlInfo = [];
            $fields = $device->getType()->getAddFields();
            if ($fields) {
                for ($i = 0; $i < count($fields); $i++) {
                    $controlInfo[$fields[$i]] = intval($form->get($fields[$i])->getData());
                }
            }
            $windows->setControlInfo($controlInfo);

            $em->persist($windows);
            $em->flush();

            $this->addFlash('success', 'Pomyślnie dodano nowe okno.');

            return $this->redirectToRoute('admin.configurate');
        }

        return $this->render('admin/add.html.twig', [
            'form' => $form->createView(),
            'title' => 'Dodaj nowe okno',
            'scripts' => ['js/add.js']
        ]);
    }

    public function deleteWindowConfigurate($id, OknaRepository $oknaRepository)
    {
        $checkAdminRole = $this->checkAdminRole();
        if ($checkAdminRole!==null) return $checkAdminRole;

        $window = $oknaRepository->find($id);
        $em = $this->getDoctrine()->getManager();

        $em->remove($window);
        $em->flush();

        return $this->redirect($this->generateUrl('admin.configurate'));
    }
}
