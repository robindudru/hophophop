<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", nullable=true)
     */
    private $mashGuide;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Style", inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $style;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=3, nullable=true)
     * @Assert\LessThanOrEqual(value=1.100, message="La densité initiale ne peut pas être supérieure à 1.100")
     * @Assert\GreaterThanOrEqual(value=1.000, message="La densité initiale ne peut pas être inférieure à 1.000")
     */
    private $originalGravity;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=3, nullable=true)
     * @Assert\LessThanOrEqual(value=1.100, message="La densité initiale ne peut pas être supérieure à 1.100")
     * @Assert\GreaterThanOrEqual(value=1.000, message="La densité initiale ne peut pas être inférieure à 1.000")
     */
    private $finalGravity;

    /**
     * @ORM\Column(type="decimal", precision=3, scale=1, nullable=true)
     */
    private $alcohol;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="recipes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $author;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Comment", mappedBy="article", orphanRemoval=true)
     */
    private $comments;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeMalts", mappedBy="recipe", orphanRemoval=true, cascade={"all"})
     */
    private $recipeMalts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeHops", mappedBy="recipe", orphanRemoval=true, cascade={"all"})
     */
    private $recipeHops;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Yeast", inversedBy="recipes")
     */
    private $yeast;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RecipeOthers", mappedBy="recipes", cascade={"all"})
     */
    private $recipeOthers;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->recipeMalts = new ArrayCollection();
        $this->recipeHops = new ArrayCollection();
        $this->recipeOthers = new ArrayCollection();
    }

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

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(User $author): self
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

    public function getMashGuide(): ?string
    {
        return $this->mashGuide;
    }

    public function setMashGuide(?string $mashGuide): self
    {
        $this->mashGuide = $mashGuide;

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

    /**
     * @return Collection|Comment[]
     */
    public function getComments(): Collection
    {
        return $this->comments;
    }

    public function addComment(Comment $comment): self
    {
        if (!$this->comments->contains($comment)) {
            $this->comments[] = $comment;
            $comment->setArticle($this);
        }

        return $this;
    }

    public function removeComment(Comment $comment): self
    {
        if ($this->comments->contains($comment)) {
            $this->comments->removeElement($comment);
            // set the owning side to null (unless already changed)
            if ($comment->getArticle() === $this) {
                $comment->setArticle(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|RecipeMalts[]
     */
    public function getRecipeMalts(): Collection
    {
        return $this->recipeMalts;
    }

    public function addRecipeMalt(RecipeMalts $recipeMalt): self
    {
        if (!$this->recipeMalts->contains($recipeMalt)) {
            $this->recipeMalts[] = $recipeMalt;
            $recipeMalt->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeMalt(RecipeMalts $recipeMalt): self
    {
        if ($this->recipeMalts->contains($recipeMalt)) {
            $this->recipeMalts->removeElement($recipeMalt);
            // set the owning side to null (unless already changed)
            if ($recipeMalt->getRecipe() === $this) {
                $recipeMalt->setRecipe(null);
            }
        }

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
            $recipeHop->setRecipe($this);
        }

        return $this;
    }

    public function removeRecipeHop(RecipeHops $recipeHop): self
    {
        if ($this->recipeHops->contains($recipeHop)) {
            $this->recipeHops->removeElement($recipeHop);
            // set the owning side to null (unless already changed)
            if ($recipeHop->getRecipe() === $this) {
                $recipeHop->setRecipe(null);
            }
        }

        return $this;
    }

    public function getYeast(): ?Yeast
    {
        return $this->yeast;
    }

    public function setYeast(?Yeast $yeast): self
    {
        $this->yeast = $yeast;

        return $this;
    }

    /**
     * @return Collection|RecipeOthers[]
     */
    public function getRecipeOthers(): Collection
    {
        return $this->recipeOthers;
    }

    public function addRecipeOther(RecipeOthers $recipeOther): self
    {
        if (!$this->recipeOthers->contains($recipeOther)) {
            $this->recipeOthers[] = $recipeOther;
            $recipeOther->setRecipes($this);
        }

        return $this;
    }

    public function removeRecipeOther(RecipeOthers $recipeOther): self
    {
        if ($this->recipeOthers->contains($recipeOther)) {
            $this->recipeOthers->removeElement($recipeOther);
            // set the owning side to null (unless already changed)
            if ($recipeOther->getRecipes() === $this) {
                $recipeOther->setRecipes(null);
            }
        }

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
