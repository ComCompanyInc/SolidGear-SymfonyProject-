<?php

namespace App\Entity;

use App\Repository\AliasDirectoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: AliasDirectoryRepository::class)]
class AliasDirectory
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\Column(length: 255)]
    private ?string $aliasName = null;

    #[ORM\Column]
    private ?int $minimalRaiting = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\OneToMany(targetEntity: User::class, mappedBy: 'aliasDirectory', orphanRemoval: true)]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getAliasName(): ?string
    {
        return $this->aliasName;
    }

    public function setAliasName(string $aliasName): static
    {
        $this->aliasName = $aliasName;

        return $this;
    }

    public function getMinimalRaiting(): ?int
    {
        return $this->minimalRaiting;
    }

    public function setMinimalRaiting(int $minimalRaiting): static
    {
        $this->minimalRaiting = $minimalRaiting;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): static
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->setAliasDirectory($this);
        }

        return $this;
    }

    public function removeUser(User $user): static
    {
        if ($this->users->removeElement($user)) {
            // set the owning side to null (unless already changed)
            if ($user->getAliasDirectory() === $this) {
                $user->setAliasDirectory(null);
            }
        }

        return $this;
    }
}
