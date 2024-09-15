<?php

namespace App\Entity;

use App\Repository\UsersFriendRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\Uid\Uuid;

#[ORM\Entity(repositoryClass: UsersFriendRepository::class)]
class UsersFriend
{
    #[ORM\Id]
    #[ORM\Column(type: UuidType::NAME, unique: true)]
    #[ORM\GeneratedValue(strategy: 'CUSTOM')]
    #[ORM\CustomIdGenerator(class: 'doctrine.uuid_generator')]
    private ?Uuid $id = null;

    #[ORM\ManyToOne(inversedBy: 'usersFriends')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $profile = null;

    #[ORM\ManyToOne(inversedBy: 'usersFriends')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $friend = null;

    public function getId(): ?Uuid
    {
        return $this->id;
    }

    public function getProfile(): ?User
    {
        return $this->profile;
    }

    public function setProfile(?User $profile): static
    {
        $this->profile = $profile;

        return $this;
    }

    public function getFriend(): ?User
    {
        return $this->friend;
    }

    public function setFriend(?User $friend): static
    {
        $this->friend = $friend;

        return $this;
    }
}
