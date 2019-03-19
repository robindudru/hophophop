<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeOthersRepository")
 */
class RecipeOthers
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
     * @ORM\ManyToOne(targetEntity="App\Entity\OtherIngredient", inversedBy="recipeOthers")
     * @ORM\JoinColumn(nullable=false)
     */
    private $otherIngredient;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipes", inversedBy="recipeOthers")
     */
    private $recipes;

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

    public function getOtherIngredient(): ?OtherIngredient
    {
        return $this->otherIngredient;
    }

    public function setOtherIngredient(?OtherIngredient $otherIngredient): self
    {
        $this->otherIngredient = $otherIngredient;

        return $this;
    }

    public function getRecipes(): ?Recipes
    {
        return $this->recipes;
    }

    public function setRecipes(?Recipes $recipes): self
    {
        $this->recipes = $recipes;

        return $this;
    }
}
