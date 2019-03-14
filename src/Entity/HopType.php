<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HopTypeRepository")
 */
class HopType
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
     * @ORM\OneToMany(targetEntity="App\Entity\Hop", mappedBy="type")
     */
    private $hops;

    public function __construct()
    {
        $this->hops = new ArrayCollection();
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
     * @return Collection|Hop[]
     */
    public function getHops(): Collection
    {
        return $this->hops;
    }

    public function addHop(Hop $hop): self
    {
        if (!$this->hops->contains($hop)) {
            $this->hops[] = $hop;
            $hop->setType($this);
        }

        return $this;
    }

    public function removeHop(Hop $hop): self
    {
        if ($this->hops->contains($hop)) {
            $this->hops->removeElement($hop);
            // set the owning side to null (unless already changed)
            if ($hop->getType() === $this) {
                $hop->setType(null);
            }
        }

        return $this;
    }
}
