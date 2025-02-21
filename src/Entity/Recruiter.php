<?php

namespace App\Entity;

use App\Repository\RecruiterRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RecruiterRepository::class)]
class Recruiter
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $companyName = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $activity = null;

    #[ORM\OneToOne(inversedBy: 'recruiter', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    /**
     * @var Collection<int, CompanyContact>
     */
    #[ORM\OneToMany(targetEntity: CompanyContact::class, mappedBy: 'recruiter')]
    private Collection $contact;

    /**
     * @var Collection<int, Offer>
     */
    #[ORM\OneToMany(targetEntity: Offer::class, mappedBy: 'recruiter', orphanRemoval: true)]
    private Collection $offers;

    public function __construct()
    {
        $this->contact = new ArrayCollection();
        $this->offers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCompanyName(): ?string
    {
        return $this->companyName;
    }

    public function setCompanyName(?string $companyName): static
    {
        $this->companyName = $companyName;

        return $this;
    }

    public function getActivity(): ?string
    {
        return $this->activity;
    }

    public function setActivity(?string $activity): static
    {
        $this->activity = $activity;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }
    
    public function setUser(User $user): static
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, CompanyContact>
     */
    public function getContact(): Collection
    {
        return $this->contact;
    }

    public function addContact(CompanyContact $contact): static
    {
        if (!$this->contact->contains($contact)) {
            $this->contact->add($contact);
            $contact->setRecruiter($this);
        }

        return $this;
    }

    public function removeContact(CompanyContact $contact): static
    {
        if ($this->contact->removeElement($contact)) {
            // set the owning side to null (unless already changed)
            if ($contact->getRecruiter() === $this) {
                $contact->setRecruiter(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Offer>
     */
    public function getOffers(): Collection
    {
        return $this->offers;
    }

    public function addOffer(Offer $offer): static
    {
        if (!$this->offers->contains($offer)) {
            $this->offers->add($offer);
            $offer->setRecruiter($this);
        }

        return $this;
    }

    public function removeOffer(Offer $offer): static
    {
        if ($this->offers->removeElement($offer)) {
            // set the owning side to null (unless already changed)
            if ($offer->getRecruiter() === $this) {
                $offer->setRecruiter(null);
            }
        }

        return $this;
    }

}
