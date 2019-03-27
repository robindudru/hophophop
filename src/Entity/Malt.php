<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaltRepository")
 */
class Malt
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     * @Assert\LessThanOrEqual(value=1300, message="Un malt ne peut pas avoir un EBC supérieur à 1300")
     * @Assert\GreaterThan(value=2, message="un malt doit avoir un EBC de 3 au minimum")
     */
    private $ebc;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\MaltTypes", inversedBy="malts")
     * @ORM\JoinColumn(nullable=false)
     */
    private $type;

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
     * @ORM\Column(type="boolean")
     */
    private $approved;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEbc(): ?int
    {
        return $this->ebc;
    }

    public function setEbc(int $ebc): self
    {
        $this->ebc = $ebc;

        return $this;
    }

    public function getType(): ?MaltTypes
    {
        return $this->type;
    }

    public function setType(?MaltTypes $type): self
    {
        $this->type = $type;

        return $this;
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

    public function getApproved(): ?bool
    {
        return $this->approved;
    }

    public function setApproved(bool $approved): self
    {
        $this->approved = $approved;

        return $this;
    }
}
