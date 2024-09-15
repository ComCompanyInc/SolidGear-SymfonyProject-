<?php

namespace App\Entity;

use App\Repository\CountryDirectoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: CountryDirectoryRepository::class)]
class CountryDirectory
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $countryName = null;

    /**
     * @var Collection<int, TownDirectory>
     */
    #[ORM\OneToMany(targetEntity: TownDirectory::class, mappedBy: 'countryDirectory', orphanRemoval: true)]
    private Collection $townDirectories;

    public function __construct()
    {
        $this->townDirectories = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getCountryName(): ?string
    {
        return $this->countryName;
    }

    public function setCountryName(string $countryName): static
    {
        $this->countryName = $countryName;

        return $this;
    }

    /**
     * @return Collection<int, TownDirectory>
     */
    public function getTownDirectories(): Collection
    {
        return $this->townDirectories;
    }

    public function addTownDirectory(TownDirectory $townDirectory): static
    {
        if (!$this->townDirectories->contains($townDirectory)) {
            $this->townDirectories->add($townDirectory);
            $townDirectory->setCountryDirectory($this);
        }

        return $this;
    }

    public function removeTownDirectory(TownDirectory $townDirectory): static
    {
        if ($this->townDirectories->removeElement($townDirectory)) {
            // set the owning side to null (unless already changed)
            if ($townDirectory->getCountryDirectory() === $this) {
                $townDirectory->setCountryDirectory(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->countryName;
    }
}
