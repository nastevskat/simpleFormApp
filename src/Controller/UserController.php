<?php
namespace App\Controller;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use App\Form\UserFormType;
use App\Repository\UserRepository;

class UserController extends AbstractController
{
    #[Route('form', name: 'form')]
    public function form(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $user->setCreatedAt(new \DateTime());
        $form = $this->createForm(UserFormType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();
            return $this->redirectToRoute('form_results');
        }
        return $this->render('form/form.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('form/results', name: 'form_results')]
    public function results(Request $request, UserRepository $userRepository): Response
    {
        $currentPage = $request->query->getInt('page', 1);
        $limit = 10; 
        $paginator = $userRepository->getAllUsers($currentPage);
        $totalUsers = $paginator->count();
        $totalUsersReturned = $paginator->getIterator()->count(); 
        $iterator = $paginator->getIterator();
        return $this->render('form/results.html.twig', [
            'users' => $paginator,
            'currentPage' => $currentPage,
            'totalPages' => ceil($totalUsers / $limit),
            'totalUsersReturned' => $totalUsersReturned,
            'totalUsers' => $totalUsers,
            'iterator' => $iterator,
        ]);
    }
}