<?php

namespace App\Entity;

use App\Repository\TownDirectoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: TownDirectoryRepository::class)]
class TownDirectory
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(inversedBy: 'townDirectories')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CountryDirectory $countryDirectory = null;

    #[ORM\Column(length: 255)]
    private ?string $townName = null;

    /**
     * @var Collection<int, Person>
     */
    #[ORM\OneToMany(targetEntity: Person::class, mappedBy: 'townDirectory', orphanRemoval: true)]
    private Collection $people;

    public function __construct()
    {
        $this->people = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCountryDirectory(): ?CountryDirectory
    {
        return $this->countryDirectory;
    }

    public function setCountryDirectory(?CountryDirectory $countryDirectory): static
    {
        $this->countryDirectory = $countryDirectory;

        return $this;
    }

    public function getTownName(): ?string
    {
        return $this->townName;
    }

    public function setTownName(string $townName): static
    {
        $this->townName = $townName;

        return $this;
    }

    function __toString()
    {
        return $this->countryDirectory . ' : ' . $this->townName;
    }

    /**
     * @return Collection<int, Person>
     */
    public function getPeople(): Collection
    {
        return $this->people;
    }

    public function addPerson(Person $person): static
    {
        if (!$this->people->contains($person)) {
            $this->people->add($person);
            $person->setTownDirectory($this);
        }

        return $this;
    }

    public function removePerson(Person $person): static
    {
        if ($this->people->removeElement($person)) {
            // set the owning side to null (unless already changed)
            if ($person->getTownDirectory() === $this) {
                $person->setTownDirectory(null);
            }
        }

        return $this;
    }
}
