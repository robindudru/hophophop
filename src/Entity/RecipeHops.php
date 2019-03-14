<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeHopsRepository")
 */
class RecipeHops
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hop", inversedBy="recipeHops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $hop;

    /**
     * @ORM\Column(type="integer")
     */
    private $boilTime;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipes", inversedBy="recipeHops")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $version;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight): self
    {
        $this->weight = $weight;

        return $this;
    }

    public function getHop(): ?Hop
    {
        return $this->hop;
    }

    public function setHop(?Hop $hop): self
    {
        $this->hop = $hop;

        return $this;
    }

    public function getBoilTime(): ?int
    {
        return $this->boilTime;
    }

    public function setBoilTime(int $boilTime): self
    {
        $this->boilTime = $boilTime;

        return $this;
    }

    public function getRecipe(): ?Recipes
    {
        return $this->recipe;
    }

    public function setRecipe(?Recipes $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    public function setVersion(string $version): self
    {
        $this->version = $version;

        return $this;
    }
}
