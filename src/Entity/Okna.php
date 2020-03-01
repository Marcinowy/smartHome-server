<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OknaRepository")
 */
class Okna
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
     * @ORM\Column(type="integer", nullable=true)
     */
    private $x_pos;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $y_pos;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Devices", inversedBy="window")
     */
    private $deviceId;

    /**
     * @ORM\Column(type="json")
     */
    private $controlInfo;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Map", inversedBy="window")
     */
    private $map;

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

    public function getXPos(): ?int
    {
        return $this->x_pos;
    }

    public function setXPos(int $x_pos): self
    {
        $this->x_pos = $x_pos;

        return $this;
    }

    public function getYPos(): ?int
    {
        return $this->y_pos;
    }

    public function setYPos(int $y_pos): self
    {
        $this->y_pos = $y_pos;

        return $this;
    }

    public function getDeviceId(): ?Devices
    {
        return $this->deviceId;
    }

    public function setDeviceId(?Devices $deviceId): self
    {
        $this->deviceId = $deviceId;

        return $this;
    }

    public function getControlInfo(): ?array
    {
        return $this->controlInfo;
    }

    public function setControlInfo(array $controlInfo): self
    {
        $this->controlInfo = $controlInfo;

        return $this;
    }

    public function getMap(): ?Map
    {
        return $this->map;
    }

    public function setMap(?Map $map): self
    {
        $this->map = $map;

        return $this;
    }
}
