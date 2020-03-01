<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MapRepository")
 */
class Map
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Okna", mappedBy="map")
     */
    private $window;

    public function __construct()
    {
        $this->window = new ArrayCollection();
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

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

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
            $window->setMap($this);
        }

        return $this;
    }

    public function removeWindow(Okna $window): self
    {
        if ($this->window->contains($window)) {
            $this->window->removeElement($window);
            // set the owning side to null (unless already changed)
            if ($window->getMap() === $this) {
                $window->setMap(null);
            }
        }

        return $this;
    }
}
