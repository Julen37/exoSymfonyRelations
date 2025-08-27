<?php

namespace App\Entity;

use App\Repository\CompanyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
class Company
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTime $fondationDate = null;

    #[ORM\ManyToOne(inversedBy: 'companies')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeOfCompany $_type = null;

    /**
     * @var Collection<int, Contract>
     */
    #[ORM\OneToMany(targetEntity: Contract::class, mappedBy: 'company', orphanRemoval: true)]
    private Collection $_contract;

    public function __construct()
    {
        $this->_contract = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getFondationDate(): ?\DateTime
    {
        return $this->fondationDate;
    }

    public function setFondationDate(\DateTime $fondationDate): static
    {
        $this->fondationDate = $fondationDate;

        return $this;
    }

    public function getType(): ?TypeOfCompany
    {
        return $this->_type;
    }

    public function setType(?TypeOfCompany $_type): static
    {
        $this->_type = $_type;

        return $this;
    }

    /**
     * @return Collection<int, Contract>
     */
    public function getContract(): Collection
    {
        return $this->_contract;
    }

    public function addContract(Contract $contract): static
    {
        if (!$this->_contract->contains($contract)) {
            $this->_contract->add($contract);
            $contract->setCompany($this);
        }

        return $this;
    }

    public function removeContract(Contract $contract): static
    {
        if ($this->_contract->removeElement($contract)) {
            // set the owning side to null (unless already changed)
            if ($contract->getCompany() === $this) {
                $contract->setCompany(null);
            }
        }

        return $this;
    }
}
