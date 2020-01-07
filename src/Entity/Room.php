<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RoomRepository")
 */
class Room
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Building", inversedBy="rooms")
     */
    private $building;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Reservation", mappedBy="room")
     */
    private $reservations;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\User", mappedBy="roomManager", cascade={"persist", "remove"})
     */
    private $manager;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", mappedBy="memberOfRoom")
     */
    private $members;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $isPrivate;

    public function __toString() {
        return $this->name;
    }

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
        $this->members = new ArrayCollection();
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

    public function getBuilding(): ?building
    {
        return $this->building;
    }

    public function setBuilding(?building $building): self
    {
        $this->building = $building;

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
            $reservation->setRoom($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            // set the owning side to null (unless already changed)
            if ($reservation->getRoom() === $this) {
                $reservation->setRoom(null);
            }
        }

        return $this;
    }

    public function getManager(): ?User
    {
        return $this->manager;
    }

    public function setManager(?User $manager): self
    {
        $this->manager = $manager;

        // set (or unset) the owning side of the relation if necessary
        $newRoomManager = null === $manager ? null : $this;
        if ($manager->getRoomManager() !== $newRoomManager) {
            $manager->setRoomManager($newRoomManager);
        }

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getMembers(): Collection
    {
        return $this->members;
    }

    public function addMember(User $member): self
    {
        if (!$this->members->contains($member)) {
            $this->members[] = $member;
            $member->addMemberOfRoom($this);
        }

        return $this;
    }

    public function removeMember(User $member): self
    {
        if ($this->members->contains($member)) {
            $this->members->removeElement($member);
            $member->removeMemberOfRoom($this);
        }

        return $this;
    }

    public function getIsPrivate(): ?bool
    {
        return $this->isPrivate;
    }

    public function setIsPrivate(?bool $isPrivate): self
    {
        $this->isPrivate = $isPrivate;

        return $this;
    }
}
