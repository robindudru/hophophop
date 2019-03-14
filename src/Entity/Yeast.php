<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\YeastRepository")
 */
class Yeast
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
    private $SBUrl;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $BLUrl;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Recipes", mappedBy="yeast")
     */
    private $recipes;

    public function __construct()
    {
        $this->recipes = new ArrayCollection();
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
     * @return Collection|Recipes[]
     */
    public function getRecipes(): Collection
    {
        return $this->recipes;
    }

    public function addRecipe(Recipes $recipe): self
    {
        if (!$this->recipes->contains($recipe)) {
            $this->recipes[] = $recipe;
            $recipe->setYeast($this);
        }

        return $this;
    }

    public function removeRecipe(Recipes $recipe): self
    {
        if ($this->recipes->contains($recipe)) {
            $this->recipes->removeElement($recipe);
            // set the owning side to null (unless already changed)
            if ($recipe->getYeast() === $this) {
                $recipe->setYeast(null);
            }
        }

        return $this;
    }
}
