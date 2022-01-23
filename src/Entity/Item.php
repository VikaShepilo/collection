<?php

namespace App\Entity;

use App\Repository\ItemRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ItemRepository::class)
 */
class Item
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nameItem;

    /**
     * @ORM\ManyToOne(targetEntity=Collections::class, inversedBy="item")
     * @ORM\JoinColumn(name="collections_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $collections;

    /**
     * @ORM\ManyToMany(targetEntity=Tag::class, inversedBy="items", cascade={"persist"})
     */
    private $tags;

    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameItem(): ?string
    {
        return $this->nameItem;
    }

    public function setNameItem(string $nameItem): self
    {
        $this->nameItem = $nameItem;

        return $this;
    }

    public function getCollections(): ?Collections
    {
        return $this->collections;
    }

    public function setCollections(?Collections $collections): self
    {
        $this->collections = $collections;

        return $this;
    }

    /**
     * @return Collection|Tag[]
     */
    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): self
    {
        if (!$this->tags->contains($tag)) {
            $this->tags[] = $tag;
            $tag->addItem($this);
        }

        return $this;
    }

    public function removeTag(Tag $tag): self
    {
        if ($this->tags->removeElement($tag)) {
            $tag->removeItem($this);
        }

        return $this;
    }

}
