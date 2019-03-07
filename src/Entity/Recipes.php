<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RecipesRepository")
 */
class Recipes
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $style;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $method;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $boilTime;

    /**
     * @ORM\Column(type="integer")
     */
    private $batchSize;

    /**
     * @ORM\Column(type="integer")
     */
    private $originalGravity;

    /**
     * @ORM\Column(type="integer")
     */
    private $boilGravity;

    /**
     * @ORM\Column(type="integer")
     */
    private $finalGravity;

    /**
     * @ORM\Column(type="integer")
     */
    private $alcohol;

    /**
     * @ORM\Column(type="integer")
     */
    private $bitterness;

    /**
     * @ORM\Column(type="integer")
     */
    private $color;

    /**
     * @ORM\Column(type="integer")
     */
    private $thumbsUp;

    /**
     * @ORM\Column(type="array")
     */
    private $malts = [];

    /**
     * @ORM\Column(type="array")
     */
    private $hops = [];

    /**
     * @ORM\Column(type="array")
     */
    private $yeast = [];

    /**
     * @ORM\Column(type="array")
     */
    private $mashGuide = [];

    /**
     * @ORM\Column(type="array")
     */
    private $otherIngredients = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getStyle(): ?string
    {
        return $this->style;
    }

    public function setStyle(string $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getMethod(): ?string
    {
        return $this->method;
    }

    public function setMethod(string $method): self
    {
        $this->method = $method;

        return $this;
    }

    public function getBoilTime(): ?string
    {
        return $this->boilTime;
    }

    public function setBoilTime(?string $boilTime): self
    {
        $this->boilTime = $boilTime;

        return $this;
    }

    public function getBatchSize(): ?int
    {
        return $this->batchSize;
    }

    public function setBatchSize(int $batchSize): self
    {
        $this->batchSize = $batchSize;

        return $this;
    }

    public function getOriginalGravity(): ?int
    {
        return $this->originalGravity;
    }

    public function setOriginalGravity(int $originalGravity): self
    {
        $this->originalGravity = $originalGravity;

        return $this;
    }

    public function getBoilGravity(): ?int
    {
        return $this->boilGravity;
    }

    public function setBoilGravity(int $boilGravity): self
    {
        $this->boilGravity = $boilGravity;

        return $this;
    }

    public function getFinalGravity(): ?int
    {
        return $this->finalGravity;
    }

    public function setFinalGravity(int $finalGravity): self
    {
        $this->finalGravity = $finalGravity;

        return $this;
    }

    public function getAlcohol(): ?int
    {
        return $this->alcohol;
    }

    public function setAlcohol(int $alcohol): self
    {
        $this->alcohol = $alcohol;

        return $this;
    }

    public function getBitterness(): ?int
    {
        return $this->bitterness;
    }

    public function setBitterness(int $bitterness): self
    {
        $this->bitterness = $bitterness;

        return $this;
    }

    public function getColor(): ?int
    {
        return $this->color;
    }

    public function setColor(int $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getThumbsUp(): ?int
    {
        return $this->thumbsUp;
    }

    public function setThumbsUp(int $thumbsUp): self
    {
        $this->thumbsUp = $thumbsUp;

        return $this;
    }

    public function getMalts(): ?array
    {
        return $this->malts;
    }

    public function setMalts(array $malts): self
    {
        $this->malts = $malts;

        return $this;
    }

    public function getHops(): ?array
    {
        return $this->hops;
    }

    public function setHops(array $hops): self
    {
        $this->hops = $hops;

        return $this;
    }

    public function getYeast(): ?array
    {
        return $this->yeast;
    }

    public function setYeast(array $yeast): self
    {
        $this->yeast = $yeast;

        return $this;
    }

    public function getMashGuide(): ?array
    {
        return $this->mashGuide;
    }

    public function setMashGuide(array $mashGuide): self
    {
        $this->mashGuide = $mashGuide;

        return $this;
    }

    public function getOtherIngredients(): ?array
    {
        return $this->otherIngredients;
    }

    public function setOtherIngredients(array $otherIngredients): self
    {
        $this->otherIngredients = $otherIngredients;

        return $this;
    }
}
