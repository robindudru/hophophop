<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipeMaltsRepository")
 */
class RecipeMalts
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $weight;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Malt")
     * @ORM\JoinColumn(nullable=false)
     */
    private $malt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Recipes", inversedBy="recipeMalts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $recipe;

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

    public function getMalt(): ?Malt
    {
        return $this->malt;
    }

    public function setMalt(?Malt $malt): self
    {
        $this->malt = $malt;

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
}
