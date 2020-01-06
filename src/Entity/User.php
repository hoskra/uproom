<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employee", inversedBy="user")
     */
    private $employee;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $superuser;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="createdBy")
     */
    private $reservations;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="targetUser")
     */
    private $myReservations;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Room", inversedBy="manager", cascade={"persist", "remove"})
     */
    private $roomManager;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Group", inversedBy="manager", cascade={"persist", "remove"})
     */
    private $groupManager;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Group", inversedBy="members")
     */
    private $memberOfGroup;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Room", inversedBy="members")
     */
    private $memberOfRoom;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->myReservations = new ArrayCollection();
        $this->memberOfGroup = new ArrayCollection();
        $this->memberOfRoom = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->name;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmployee(): ?Employee
    {
        return $this->employee;
    }

    public function setEmployee(?Employee $employee): self
    {
        $this->employee = $employee;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getSuperuser(): ?bool
    {
        return $this->superuser;
    }

    public function setSuperuser(?bool $superuser): self
    {
        $this->superuser = $superuser;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->setCreatedBy($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getCreatedBy() === $this) {
                $reservation->setCreatedBy(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getMyReservations(): Collection
    {
        return $this->myReservations;
    }

    public function addMyReservation(Reservation $myReservation): self
    {
        if (!$this->myReservations->contains($myReservation)) {
            $this->myReservations[] = $myReservation;
            $myReservation->setTargetUser($this);
        }

        return $this;
    }

    public function removeMyReservation(Reservation $myReservation): self
    {
        if ($this->myReservations->contains($myReservation)) {
            $this->myReservations->removeElement($myReservation);
            // set the owning side to null (unless already changed)
            if ($myReservation->getTargetUser() === $this) {
                $myReservation->setTargetUser(null);
            }
        }

        return $this;
    }

    public function getRoomManager(): ?room
    {
        return $this->roomManager;
    }

    public function setRoomManager(?room $roomManager): self
    {
        $this->roomManager = $roomManager;

        return $this;
    }

    public function getGroupManager(): ?group
    {
        return $this->groupManager;
    }

    public function setGroupManager(?group $groupManager): self
    {
        $this->groupManager = $groupManager;

        return $this;
    }

    /**
     * @return Collection|group[]
     */
    public function getMemberOfGroup(): Collection
    {
        return $this->memberOfGroup;
    }

    public function addMemberOfGroup(group $memberOfGroup): self
    {
        if (!$this->memberOfGroup->contains($memberOfGroup)) {
            $this->memberOfGroup[] = $memberOfGroup;
        }

        return $this;
    }

    public function removeMemberOfGroup(group $memberOfGroup): self
    {
        if ($this->memberOfGroup->contains($memberOfGroup)) {
            $this->memberOfGroup->removeElement($memberOfGroup);
        }

        return $this;
    }

    /**
     * @return Collection|room[]
     */
    public function getMemberOfRoom(): Collection
    {
        return $this->memberOfRoom;
    }

    public function addMemberOfRoom(room $memberOfRoom): self
    {
        if (!$this->memberOfRoom->contains($memberOfRoom)) {
            $this->memberOfRoom[] = $memberOfRoom;
        }

        return $this;
    }

    public function removeMemberOfRoom(room $memberOfRoom): self
    {
        if ($this->memberOfRoom->contains($memberOfRoom)) {
            $this->memberOfRoom->removeElement($memberOfRoom);
        }

        return $this;
    }
}
