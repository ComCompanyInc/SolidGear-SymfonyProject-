<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Person $person = null;

    #[ORM\ManyToOne(inversedBy: 'users')]
    #[ORM\JoinColumn(nullable: false)]
    private ?AliasDirectory $aliasDirectory = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateRegistration = null;

    #[ORM\Column(length: 255)]
    private ?string $urlAddress = null;

    #[ORM\Column(length: 255)]
    private ?string $login = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column]
    private ?bool $isRejected = null;

    #[ORM\Column]
    private ?int $mainRaiting = null;

    /**
     * @var Collection<int, UsersFriend>
     */
    #[ORM\OneToMany(targetEntity: UsersFriend::class, mappedBy: 'profile', orphanRemoval: true)]
    private Collection $usersFriends;

    /**
     * @var Collection<int, Mail>
     */
    #[ORM\OneToMany(targetEntity: Mail::class, mappedBy: 'sender', orphanRemoval: true)]
    private Collection $mails;

    /**
     * @var Collection<int, Publication>
     */
    #[ORM\OneToMany(targetEntity: Publication::class, mappedBy: 'profile', orphanRemoval: true)]
    private Collection $publications;

    public function __construct()
    {
        $this->usersFriends = new ArrayCollection();
        $this->mails = new ArrayCollection();
        $this->publications = new ArrayCollection();
    }

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getPerson(): ?Person
    {
        return $this->person;
    }

    public function setPerson(?Person $person): static
    {
        $this->person = $person;

        return $this;
    }

    public function getAliasDirectory(): ?AliasDirectory
    {
        return $this->aliasDirectory;
    }

    public function setAliasDirectory(?AliasDirectory $aliasDirectory): static
    {
        $this->aliasDirectory = $aliasDirectory;

        return $this;
    }

    public function getDateRegistration(): ?\DateTimeInterface
    {
        return $this->dateRegistration;
    }

    public function setDateRegistration(\DateTimeInterface $dateRegistration): static
    {
        $this->dateRegistration = $dateRegistration;

        return $this;
    }

    public function getUrlAddress(): ?string
    {
        return $this->urlAddress;
    }

    public function setUrlAddress(string $urlAddress): static
    {
        $this->urlAddress = $urlAddress;

        return $this;
    }

    public function getLogin(): ?string
    {
        return $this->login;
    }

    public function setLogin(string $login): static
    {
        $this->login = $login;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function isRejected(): ?bool
    {
        return $this->isRejected;
    }

    public function setRejected(bool $isRejected): static
    {
        $this->isRejected = $isRejected;

        return $this;
    }

    public function getMainRaiting(): ?int
    {
        return $this->mainRaiting;
    }

    public function setMainRaiting(int $mainRaiting): static
    {
        $this->mainRaiting = $mainRaiting;

        return $this;
    }

    /**
     * @return Collection<int, UsersFriend>
     */
    public function getUsersFriends(): Collection
    {
        return $this->usersFriends;
    }

    public function addUsersFriend(UsersFriend $usersFriend): static
    {
        if (!$this->usersFriends->contains($usersFriend)) {
            $this->usersFriends->add($usersFriend);
            $usersFriend->setProfile($this);
        }

        return $this;
    }

    public function removeUsersFriend(UsersFriend $usersFriend): static
    {
        if ($this->usersFriends->removeElement($usersFriend)) {
            // set the owning side to null (unless already changed)
            if ($usersFriend->getProfile() === $this) {
                $usersFriend->setProfile(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Mail>
     */
    public function getMails(): Collection
    {
        return $this->mails;
    }

    public function addMail(Mail $mail): static
    {
        if (!$this->mails->contains($mail)) {
            $this->mails->add($mail);
            $mail->setSender($this);
        }

        return $this;
    }

    public function removeMail(Mail $mail): static
    {
        if ($this->mails->removeElement($mail)) {
            // set the owning side to null (unless already changed)
            if ($mail->getSender() === $this) {
                $mail->setSender(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Publication>
     */
    public function getPublications(): Collection
    {
        return $this->publications;
    }

    public function addPublication(Publication $publication): static
    {
        if (!$this->publications->contains($publication)) {
            $this->publications->add($publication);
            $publication->setProfile($this);
        }

        return $this;
    }

    public function removePublication(Publication $publication): static
    {
        if ($this->publications->removeElement($publication)) {
            // set the owning side to null (unless already changed)
            if ($publication->getProfile() === $this) {
                $publication->setProfile(null);
            }
        }

        return $this;
    }

    public function getRoles(): array
    {
        // TODO: Implement getRoles() method.
        return ['ROLE_USER'];
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    public function getUserIdentifier(): string
    {
        // TODO: Implement getUserIdentifier() method.
        return $this->login;
    }
}
