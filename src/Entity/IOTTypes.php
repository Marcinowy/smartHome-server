<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\IOTTypesRepository")
 */
class IOTTypes
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
     * @ORM\OneToMany(targetEntity="App\Entity\Devices", mappedBy="type")
     */
    private $device;

    /**
     * @ORM\Column(type="json")
     */
    private $addFields;

    public function __construct()
    {
        $this->device = new ArrayCollection();
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
     * @return Collection|Devices[]
     */
    public function getDevice(): Collection
    {
        return $this->device;
    }

    public function addDevice(Devices $device): self
    {
        if (!$this->device->contains($device)) {
            $this->device[] = $device;
            $device->setType($this);
        }

        return $this;
    }

    public function removeDevice(Devices $device): self
    {
        if ($this->device->contains($device)) {
            $this->device->removeElement($device);
            // set the owning side to null (unless already changed)
            if ($device->getType() === $this) {
                $device->setType(null);
            }
        }

        return $this;
    }

    public function getAddFields(): ?array
    {
        return $this->addFields;
    }

    public function setAddFields(array $addFields): self
    {
        $this->addFields = $addFields;

        return $this;
    }
}
