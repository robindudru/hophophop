<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\HopRepository")
 */
class Hop
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
     * @ORM\Column(type="decimal", precision=3, scale=1)
     */
    private $alphaAcid;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\HopType", inversedBy="hops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $SBUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BLUrl;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeHops", mappedBy="hop")
     */
    private $recipeHops;

    public function __construct()
    {
        $this->recipeHops = new ArrayCollection();
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

    public function getAlphaAcid()
    {
        return $this->alphaAcid;
    }

    public function setAlphaAcid($alphaAcid): self
    {
        $this->alphaAcid = $alphaAcid;

        return $this;
    }

    public function getType(): ?HopType
    {
        return $this->type;
    }

    public function setType(?HopType $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getSBUrl(): ?string
    {
        return $this->SBUrl;
    }

    public function setSBUrl(?string $SBUrl): self
    {
        $this->SBUrl = $SBUrl;

        return $this;
    }

    public function getBLUrl(): ?string
    {
        return $this->BLUrl;
    }

    public function setBLUrl(?string $BLUrl): self
    {
        $this->BLUrl = $BLUrl;

        return $this;
    }

    /**
     * @return Collection|RecipeHops[]
     */
    public function getRecipeHops(): Collection
    {
        return $this->recipeHops;
    }

    public function addRecipeHop(RecipeHops $recipeHop): self
    {
        if (!$this->recipeHops->contains($recipeHop)) {
            $this->recipeHops[] = $recipeHop;
            $recipeHop->setHop($this);
        }

        return $this;
    }

    public function removeRecipeHop(RecipeHops $recipeHop): self
    {
        if ($this->recipeHops->contains($recipeHop)) {
            $this->recipeHops->removeElement($recipeHop);
            // set the owning side to null (unless already changed)
            if ($recipeHop->getHop() === $this) {
                $recipeHop->setHop(null);
            }
        }

        return $this;
    }
}
