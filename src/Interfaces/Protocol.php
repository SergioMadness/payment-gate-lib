<?php namespace professionalweb\Paycloud\Interfaces;

/**
 * Interface for protocol wrapper
 * @package professionalweb\Paycloud\Interfaces
 */
interface Protocol
{
    /**
     * Get data
     *
     * @param string $method
     * @param array  $data
     *
     * @return array
     */
    public function get(string $method, array $data = []): array;

    /**
     * Exec some operation
     *
     * @param string $method
     * @param array  $data
     *
     * @return array
     */
    public function execute(string $method, array $data = []): array;
}