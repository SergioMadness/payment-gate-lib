<?php namespace professionalweb\Paycloud\Interfaces\Models;

/**
 * Interface for product
 * @package professionalweb\Paycloud\Interfaces\Models
 */
interface Product
{
    /**
     * Get product id
     *
     * @return string
     */
    public function getId(): string;

    /**
     * Get product name
     *
     * @return string
     */
    public function getName(): string;

    /**
     * Get product price
     *
     * @return float
     */
    public function getPrice(): float;
}