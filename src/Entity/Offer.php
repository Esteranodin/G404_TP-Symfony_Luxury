<?php

namespace App\Entity;

use App\Repository\OfferRepository;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OfferRepository::class)]
class Offer
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isActivated = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $location = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $content = null;

    #[ORM\Column(type: Types::INTEGER)]
     private ?int $salary = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $closingAt = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Recruiter $recruiter = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ContractType $contractType = null;

    #[ORM\ManyToOne(inversedBy: 'offers')]
    private ?Sector $sectorJob = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;


    public function __construct(DateTimeImmutable $createdAt = new DateTimeImmutable(), DateTimeImmutable $updatedAt = new DateTimeImmutable())
    {
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }

    public function isActivated(): ?bool
    {
        return $this->isActivated;
    }

    public function setIsActivated(?bool $isActivated): static
    {
        $this->isActivated = $isActivated;

        return $this;
    }

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(?string $location): static
    {
        $this->location = $location;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): static
    {
        $this->salary = $salary;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getClosingAt(): ?\DateTimeImmutable
    {
        return $this->closingAt;
    }

    public function setClosingAt(\DateTimeImmutable $closingAt): static
    {
        $this->closingAt = $closingAt;

        return $this;
    }

    public function getRecruiter(): ?Recruiter
    {
        return $this->recruiter;
    }

    public function setRecruiter(?Recruiter $recruiter): static
    {
        $this->recruiter = $recruiter;

        return $this;
    }

   
    public function getContractType(): ?ContractType
    {
        return $this->contractType;
    }

    public function setContractType(?ContractType $contractType): static
    {
        $this->contractType = $contractType;

        return $this;
    }

    public function getSectorJob(): ?Sector
    {
        return $this->sectorJob;
    }

    public function setSectorJob(?Sector $sectorJob): static
    {
        $this->sectorJob = $sectorJob;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

        return $this;
    }
}
