<?php namespace professionalweb\Paycloud\Services;

use professionalweb\Paycloud\Interfaces\Protocol;
use professionalweb\Paycloud\Interfaces\DataSigner;

/**
 * Wrapper for paycloud protocol
 * @package professionalweb\Paycloud\Services
 */
class PaycloudProtocol implements Protocol
{
    public const METHOD_POST = 'post';

    public const METHOD_GET = 'get';

    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var string
     */
    private $token;

    /**
     * @var string
     */
    private $secret;

    /**
     * @var DataSigner
     */
    private $dataSigner;

    public function __construct(string $url, string $token, string $secret, DataSigner $dataSigner)
    {
        $this->setBaseUrl($url)->setToken($token)->setSecret($secret)->setDataSigner($dataSigner);
    }

    /**
     * Get data
     *
     * @param string $method
     * @param array  $data
     *
     * @return array
     * @throws \Exception
     */
    public function get(string $method, array $data = []): array
    {
        $response = $this->call(self::METHOD_GET, $this->prepareUrl($method), $this->prepareParams($data));

        return json_decode($response, true);
    }

    /**
     * Exec some operation
     *
     * @param string $method
     * @param array  $data
     *
     * @return array
     * @throws \Exception
     */
    public function execute(string $method, array $data = []): array
    {
        $response = $this->call(self::METHOD_POST, $this->prepareUrl($method), $this->prepareParams($data));

        return json_decode($response, true);
    }

    /**
     * Call some method
     *
     * @param string $method
     * @param string $url
     * @param array  $data
     *
     * @return string
     * @throws \Exception
     */
    protected function call(string $method, string $url, array $data): string
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        if ($method === self::METHOD_POST) {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        } else {
            $params = http_build_query($data);
            $url .= '?' . $params;
        }
        curl_setopt($curl, CURLOPT_URL, $url);

        $response = curl_exec($curl);
        $responseO = json_decode($response, true);
        $error = curl_error($curl);
        $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($error) {
            throw new \Exception($error);
        }
        if ($status >= 400) {
            throw new \Exception($responseO[0]['message'] ?? $status);
        }

        return $response;
    }

    /**
     * Prepare URL
     *
     * @param string $url
     *
     * @return string
     */
    protected function prepareUrl(string $url): string
    {
        return rtrim($this->getBaseUrl(), '/') . '/' . ltrim($url, '/');
    }

    /**
     * Prepare params
     *
     * @param array $params
     *
     * @return array
     */
    protected function prepareParams(array $params): array
    {
        $params['client_id'] = $this->getToken();
        $params['signature'] = $this->getDataSigner()->sign($params, $this->getSecret());

        return $params;
    }

    //<editor-fold desc="Getters and setters">

    /**
     * @return string
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     *
     * @return $this
     */
    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     *
     * @return $this
     */
    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    /**
     * @return string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }

    /**
     * @param string $secret
     *
     * @return $this
     */
    public function setSecret(string $secret): self
    {
        $this->secret = $secret;

        return $this;
    }

    /**
     * @return DataSigner
     */
    public function getDataSigner(): DataSigner
    {
        return $this->dataSigner;
    }

    /**
     * @param DataSigner $dataSigner
     *
     * @return $this
     */
    public function setDataSigner(DataSigner $dataSigner): self
    {
        $this->dataSigner = $dataSigner;

        return $this;
    }
    //</editor-fold>
}