<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\DevicesRepository")
 */
class Devices
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $mac;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $token;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Okna", mappedBy="deviceId")
     */
    private $window;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\IOTTypes", inversedBy="device")
     */
    private $type;

    public function __construct()
    {
        $this->window = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIp(): ?string
    {
        return $this->ip;
    }

    public function setIp(string $ip): self
    {
        $this->ip = $ip;

        return $this;
    }

    public function getMac(): ?string
    {
        return $this->mac;
    }

    public function setMac(string $mac): self
    {
        $this->mac = $mac;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return Collection|Okna[]
     */
    public function getWindow(): Collection
    {
        return $this->window;
    }

    public function addWindow(Okna $window): self
    {
        if (!$this->window->contains($window)) {
            $this->window[] = $window;
            $window->setDeviceId($this);
        }

        return $this;
    }

    public function removeWindow(Okna $window): self
    {
        if ($this->window->contains($window)) {
            $this->window->removeElement($window);
            // set the owning side to null (unless already changed)
            if ($window->getDeviceId() === $this) {
                $window->setDeviceId(null);
            }
        }

        return $this;
    }

    public function getType(): ?IOTTypes
    {
        return $this->type;
    }

    public function setType(?IOTTypes $type): self
    {
        $this->type = $type;

        return $this;
    }
}
