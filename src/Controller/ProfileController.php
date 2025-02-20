<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\User;
use App\Form\CandidateType;
use App\Interfaces\FileHandlerInterface;
use App\Interfaces\PasswordUpdaterInterface;
use App\Interfaces\ProfileProgressCalculatorInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(Request $request, EntityManagerInterface $entityManager, FileHandlerInterface $fileHandler, PasswordUpdaterInterface $passwordUpdater, ProfileProgressCalculatorInterface $progressCalculator): Response
    {
        /** @var User */
        $user = $this->getUser();
 
        if (!$user->isVerified()) {
            return $this->render('errors/not-verified.html.twig', []);
        }
        
        $candidate = $user->getCandidate();

        if (!$candidate) {
            $candidate = new Candidate();
            $candidate->setUser($user);
            $entityManager->persist($candidate);
            $entityManager->flush();
        }

        $formCandidate = $this->createForm(CandidateType::class, $candidate);
        $formCandidate->handleRequest($request);

        if ($formCandidate->isSubmitted() && $formCandidate->isValid()) {

            $files = [
                'profilePicPath' => $formCandidate->get('profilePicture')->getData(),
                'passportPath' => $formCandidate->get('passportPicture')->getData(),
                'cvPath' => $formCandidate->get('cvPicture')->getData(),
            ];

            $fileHandler->handleFiles($candidate, $files);

            $email = $formCandidate->get('email')->getData();
            $newPassword = $formCandidate->get('newPassword')->getData();

            if ($email && $newPassword) {
                $passwordUpdater->updatePassword($user, $email, $newPassword);
            } elseif ($email || $newPassword) {
                $this->addFlash('danger', 'Email and password must be filled together to change password.');
            }

            $progressCalculator->calculProgress($candidate);

            $entityManager->persist($candidate);
            $entityManager->flush();

            $this->addFlash('success', 'Profile updated successfully');

            return $this->redirectToRoute('app_profile');
        }

        return $this->render('profile/index.html.twig', [
            'formCandidate' => $formCandidate->createView(),
            'candidate' => $candidate,
            'originalProfilPicture' => $this->getOriginalFilename($candidate->getProfilePicPath()),
            'originalPassport' => $this->getOriginalFilename($candidate->getPassportPath()),
            'originalCv' => $this->getOriginalFilename($candidate->getCvPath()),
        ]);
    }

    #[Route('/profil/delete/{id}', name: 'app_profile_delete')]

    public function delete(Candidate $candidate, EntityManagerInterface $entityManager) : Response {

        // Pour verifier que la personne qui supprime est bien celle qui est connectée
           /** @var User */
           $user = $this->getUser();
           if ($user->getCandidate() !== $candidate) {
               $this->addFlash('danger', 'You are not allowed to delete this profile!, the admin will be informed of this action.');
               return $this->redirectToRoute('app_profile');
           }
           
           $candidate->setDeletedAt(new \DateTimeImmutable());
           $user->setRoles(['ROLE_DELETED']);
           $entityManager->flush();
           return $this->redirectToRoute('app_logout');
       }

    private function getOriginalFilename(?string $filename): ?string
    {
        return $filename ? preg_replace('/-\w{13}(?=\.\w{3,4}$)/', '', $filename) : null;
    }

}


