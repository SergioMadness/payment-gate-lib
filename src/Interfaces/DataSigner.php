<?php namespace professionalweb\Paycloud\Interfaces;

/**
 * Interface for data signer
 * @package professionalweb\Paycloud\Interfaces
 */
interface DataSigner
{
    /**
     * Sign data
     *
     * @param        $data
     * @param string $key
     *
     * @return string
     */
    public function sign($data, string $key): string;

    /**
     * validate signature
     *
     * @param        $data
     * @param string $key
     * @param string $signature
     *
     * @return bool
     */
    public function validate($data, string $key, string $signature): bool;
}