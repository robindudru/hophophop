<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaltTypesRepository")
 */
class MaltTypes
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
     * @ORM\OneToMany(targetEntity="App\Entity\Malt", mappedBy="type")
     */
    private $malts;

    public function __construct()
    {
        $this->malts = new ArrayCollection();
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
     * @return Collection|Malt[]
     */
    public function getMalts(): Collection
    {
        return $this->malts;
    }

    public function addMalt(Malt $malt): self
    {
        if (!$this->malts->contains($malt)) {
            $this->malts[] = $malt;
            $malt->setType($this);
        }

        return $this;
    }

    public function removeMalt(Malt $malt): self
    {
        if ($this->malts->contains($malt)) {
            $this->malts->removeElement($malt);
            // set the owning side to null (unless already changed)
            if ($malt->getType() === $this) {
                $malt->setType(null);
            }
        }

        return $this;
    }
}
