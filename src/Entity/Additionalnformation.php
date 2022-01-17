<?php

namespace App\Entity;

use App\Repository\AdditionalnformationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AdditionalnformationRepository::class)
 */
class Additionalnformation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $fees;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $placeInTheTop;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $numberOfAwards;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $genre;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $commentTop;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $review;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $criticism;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $publicationDate;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $authorIsDateOfBirth;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $developmentDate;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $integrityOfHistory;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $oneAuthor;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $abultContent;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFees(): ?int
    {
        return $this->fees;
    }

    public function setFees(?int $fees): self
    {
        $this->fees = $fees;

        return $this;
    }

    public function getPlaceInTheTop(): ?int
    {
        return $this->placeInTheTop;
    }

    public function setPlaceInTheTop(?int $placeInTheTop): self
    {
        $this->placeInTheTop = $placeInTheTop;

        return $this;
    }

    public function getNumberOfAwards(): ?int
    {
        return $this->numberOfAwards;
    }

    public function setNumberOfAwards(?int $numberOfAwards): self
    {
        $this->numberOfAwards = $numberOfAwards;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(?string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCommentTop(): ?string
    {
        return $this->commentTop;
    }

    public function setCommentTop(?string $commentTop): self
    {
        $this->commentTop = $commentTop;

        return $this;
    }

    public function getReview(): ?string
    {
        return $this->review;
    }

    public function setReview(?string $review): self
    {
        $this->review = $review;

        return $this;
    }

    public function getCriticism(): ?string
    {
        return $this->criticism;
    }

    public function setCriticism(?string $criticism): self
    {
        $this->criticism = $criticism;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(?\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getAuthorIsDateOfBirth(): ?\DateTimeInterface
    {
        return $this->authorIsDateOfBirth;
    }

    public function setAuthorIsDateOfBirth(?\DateTimeInterface $authorIsDateOfBirth): self
    {
        $this->authorIsDateOfBirth = $authorIsDateOfBirth;

        return $this;
    }

    public function getDevelopmentDate(): ?\DateTimeInterface
    {
        return $this->developmentDate;
    }

    public function setDevelopmentDate(?\DateTimeInterface $developmentDate): self
    {
        $this->developmentDate = $developmentDate;

        return $this;
    }

    public function getIntegrityOfHistory(): ?bool
    {
        return $this->integrityOfHistory;
    }

    public function setIntegrityOfHistory(?bool $integrityOfHistory): self
    {
        $this->integrityOfHistory = $integrityOfHistory;

        return $this;
    }

    public function getOneAuthor(): ?bool
    {
        return $this->oneAuthor;
    }

    public function setOneAuthor(?bool $oneAuthor): self
    {
        $this->oneAuthor = $oneAuthor;

        return $this;
    }

    public function getAbultContent(): ?bool
    {
        return $this->abultContent;
    }

    public function setAbultContent(?bool $abultContent): self
    {
        $this->abultContent = $abultContent;

        return $this;
    }
}
