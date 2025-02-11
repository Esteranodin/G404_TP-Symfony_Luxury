<?php

namespace App\Controller;

use App\Entity\Candidate;
use App\Entity\User;
use App\Form\CandidateType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
// use Symfony\Component\Form\FileUploadError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'app_profile')]
    public function index(EntityManagerInterface $entityManager, Request $request, FileUploader $fileUploader): Response
    {
        /** @var User */
        $user = $this->getUser();

        $candidate = $user->getCandidate();

        if (!$user->isVerified()) {
            return $this->render('errors/not-verified.html.twig', []);
        }

        if (!$candidate) {
            $candidate = new Candidate();
            $candidate->setUser($user);
            $entityManager->persist($candidate);
            $entityManager->flush();
        }


        $formCandidate = $this->createForm(CandidateType::class, $candidate);
        $formCandidate->handleRequest($request);

        if ($formCandidate->isSubmitted() && $formCandidate->isValid()) {

             /** @var UploadedFile $profilePictureFile */
            $profilPictureFile = $formCandidate->get('profilePicture')->getData();

            // dd($profilPictureFile);

            // condition necessaire car champs profilePicture = not required
            if ($profilPictureFile) {
                $profilPictureName = $fileUploader->upload($profilPictureFile, $candidate, 'profilePicPath', 'profile_pictures');
                $candidate->setProfilePicPath($profilPictureName);
            }

            
            $entityManager->persist($candidate);
            $entityManager->flush();

            $this->addFlash('success', 'Profile updated successfully');

            return $this->redirectToRoute('app_profile');
        }

        if ($candidate->getProfilePicPath()) {
            $originalProfilePictureFilename = preg_replace('/-\w{13}(?=\.\w{3,4}$)/', '', $candidate->getProfilePicPath());
        }


        return $this->render('profile/index.html.twig', [
            'formCandidate' => $formCandidate->createView(),
            'candidate' => $candidate,
            'originalProfilPicture' => $originalProfilePictureFilename ?? null,
        ]);
    }
}
