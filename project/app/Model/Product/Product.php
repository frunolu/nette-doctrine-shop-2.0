<?php
declare(strict_types=1);

namespace App\Model\Product;

use App\Model\Category\Category;
use DateTimeImmutable;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="product"
 * )
 */
class Product
{

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="url", type="string", nullable=false)
     */
    private string $url;

    /**
     * @ORM\Column(name="short_description", type="string", nullable=true)
     */
    private ?string $shortDescription;

    /**
     * @var Category[]|Collection
     * @ORM\ManyToMany(targetEntity="App\Model\Category\Category",mappedBy="products")
     */
    private Collection $categories;

    /**
     * @ORM\Column(name="created", type="datetime_immutable", nullable=false)
     */
    private DateTimeImmutable $created;

    /**
     * @ORM\Column(name="updated", type="datetime_immutable", nullable=true)
     */
    private ?DateTimeImmutable $updated;

    /**
     * @ORM\Column(name="deleted", type="integer", nullable=false)
     */
    private int $deleted = 0;

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function setUrl(string $url): void
    {
        $this->url = $url;
    }

    public function getShortDescription(): ?string
    {
        return $this->shortDescription;
    }

    public function setShortDescription(string $shortDescription): void
    {
        $this->shortDescription = $shortDescription;
    }

    /**
     * @return Category[]|Collection
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getUpdated(): ?DateTimeImmutable
    {
        return $this->updated;
    }

    public function setUpdated(?DateTimeImmutable $updated): void
    {
        $this->updated = $updated;
    }

    public function getDeleted(): int
    {
        return $this->deleted;
    }

    public function setDeleted(int $deleted): void
    {
        $this->deleted = $deleted;
    }

}
