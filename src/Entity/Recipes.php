<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @Assert\Length(min=3, max=255, minMessage="Le titre doit contenir au moins 3 caractères")
     */
    private $title;

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
     * @ORM\Column(type="integer", length=255, nullable=true)
     * @Assert\LessThan(value=300, message="Cela semble bien long pour bouillir...")
     */
    private $boilTime;

    /**
     * @ORM\Column(type="integer")
     * @Assert\LessThan(value=101, message="Restons sobres... pas plus de 100 litres !")
     */
    private $batchSize;


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
     * @ORM\Column(type="string", nullable=true)
     */
    private $mashGuide;

    /**
     * @ORM\Column(type="array")
     */
    private $otherIngredients = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Style", inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $style;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=3, nullable=true)
     */
    private $originalGravity;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=3, nullable=true)
     */
    private $finalGravity;

    /**
     * @ORM\Column(type="decimal", precision=2, scale=1, nullable=true)
     */
    private $alcohol;

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

    public function getMashGuide(): ?string
    {
        return $this->mashGuide;
    }

    public function setMashGuide(?string $mashGuide): self
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

    public function getStyle(): ?Style
    {
        return $this->style;
    }

    public function setStyle(?Style $style): self
    {
        $this->style = $style;

        return $this;
    }

    public function getOriginalGravity()
    {
        return $this->originalGravity;
    }

    public function setOriginalGravity($originalGravity): self
    {
        $this->originalGravity = $originalGravity;

        return $this;
    }

    public function getFinalGravity()
    {
        return $this->finalGravity;
    }

    public function setFinalGravity($finalGravity): self
    {
        $this->finalGravity = $finalGravity;

        return $this;
    }

    public function getAlcohol()
    {
        return $this->alcohol;
    }

    public function setAlcohol($alcohol): self
    {
        $this->alcohol = $alcohol;

        return $this;
    }
}
