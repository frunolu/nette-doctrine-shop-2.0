<?php

declare(strict_types=1);

namespace App\Model\Category;

use App\Model\Product\Product;
use DateTimeImmutable;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 *     name="category",
 *     indexes={
 *     @ORM\Index(name="parent_id", columns={"parent_id"}),
 *     @ORM\Index(name="lft_rgt", columns={"lft","rgt"})
 *     }
 * )
 */
class Category
{
    public const TABLE_NAME = 'category';

    public const COLUMN_ID = 'id';
    public const COLUMN_PARENT = 'parent_id';
    public const COLUMN_NAME = 'name';
    public const COLUMN_URL = 'url';
    public const COLUMN_CREATED = 'created';
    public const COLUMN_UPDATED = 'updated';
    public const COLUMN_DELETED = 'deleted';

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private int $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Model\Category\Category", inversedBy="children")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private ?Category $parent;

    /**
     * @var Category[]|Collection
     * @ORM\OneToMany(targetEntity="App\Model\Category\Category", mappedBy="parent")
     */
    private Collection $children;

    /**
     * @var Product[]|Collection
     * @ORM\ManyToMany(targetEntity="App\Model\Product\Product", inversedBy="categories")
     * @ORM\JoinTable(
     *     name="product_category",
     *     joinColumns={@ORM\JoinColumn(name="category_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")}
     *)
     */
    private Collection $products;

    /**
     * @ORM\Column(name="name", type="string", nullable=false)
     */
    private string $name;

    /**
     * @ORM\Column(name="url", type="string", nullable=false)
     */
    private string $url;

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


    public function __construct()
    {
        $this->children = new ArrayCollection();
        $this->products = new ArrayCollection();
    }

    public static function createFromArray(array $data): self
    {
        $category  = new self();
        $category->id = $data[self::COLUMN_ID];
        $category->name = $data[self::COLUMN_NAME];
        $category->parent = $data[self::COLUMN_PARENT];
        $category->url = $data[self::COLUMN_URL];
        $category->created = $data[self::COLUMN_CREATED];
        $category->updated = $data[self::COLUMN_UPDATED];
        $category->deleted = $data[self::COLUMN_DELETED];

        return $category;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getParent(): ?Category
    {
        return $this->parent;
    }

    public function setParent(?Category $parent): void
    {
        $this->parent = $parent;
    }

    public function getChildren(): Collection
    {
        return $this->children;
    }

    public function addChild(Category $category): void
    {
        if ($this->children->contains($category) === false) {
            $this->children->add($category);
        }
    }

    /**
     * @return Product[]|Collection
     */
    public function getProducts(): Collection
    {
        return $this->products;
    }

    public function addProduct(Product $product): void
    {
        if ($this->products->contains($product) === false) {
            $this->children->add($product);
        }
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

    public function getCreated(): DateTimeImmutable
    {
        return $this->created;
    }

    public function getUpdated(): DateTimeImmutable
    {
        return $this->updated;
    }

    public function setUpdated(DateTimeImmutable $updated): void
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
