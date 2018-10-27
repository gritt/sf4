<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please, inform a title")
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\Length(
     *      min = 2,
     *      max = 4000,
     *      minMessage = "The description must have be at least 2 characters long",
     *      maxMessage = "The description cannot be longer than 4000 characters"
     * )
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Please, upload the image brochure as a PNG or JPEG file.")
     * @Assert\Image(mimeTypes={"image/jpeg", "image/png"}, mimeTypesMessage="Sorry, unsupported extension")
     */
    private $image;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotNull(message="Please, define the stock amount")
     * @Assert\GreaterThan(0)
     */
    private $stock;

    /**
     * Many Products have Many Tags.
     *
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Tag", inversedBy="products")
     * @ORM\JoinTable(name="product_tags",
     *      joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
     *      )
     */
    private $tags;


    public function __construct()
    {
        $this->tags = new ArrayCollection();
    }

    public function __toString(): ?string
    {
        return $this->title;
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

        return $this;
    }

    public function getTags(): ?Collection
    {
        return $this->tags;
    }

    public function setTags(ArrayCollection $tags): self
    {
        $this->tags = $tags;

        return $this;
    }

    public function addTag(Tag $tag): void
    {
        if ($this->tags->contains($tag)) {
            return;
        }

        $this->tags->add($tag);
        $tag->addProduct($this);
    }

    public function removeTag(Tag $tag): void
    {
        if (!$this->tags->contains($tag)) {
            return;
        }

        $this->tags->removeElement($tag);
        $tag->removeProduct($this);
    }
}
