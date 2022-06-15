<?php namespace professionalweb\Paycloud\Models;

use professionalweb\Paycloud\Interfaces\Models\Product as IProduct;

/**
 * Base product class
 * @package professionalweb\Paycloud\Models
 */
class Product implements IProduct
{

    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var float
     */
    private $price;

    public function __construct(string $id = '', string $name = '', float $price = 0)
    {
        $this->setId($id)->setName($name)->setPrice($price);
    }

    /**
     * Set id
     *
     * @param string $id
     *
     * @return Product
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get product id
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id ?? '';
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Product
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get product name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name ?? '';
    }

    /**
     * Set price
     *
     * @param float $price
     *
     * @return Product
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get product price
     *
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price ?? 0;
    }
}