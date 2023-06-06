<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http as HttpClient;
trait ServiceCommunicationTrait
{
    use BaseApiResponse;

    /**
     * Forward the request to an external service.
     *
     * @param string $method
     * @param string $url
     * @param array $params
     * @param array $headers
     * @return JsonResponse
     */
    public function forwardRequest(string $method, string $url, array $params = [], array $headers = [])
    {
  

        if (request()->headers->has('Authorization')) {
            $headers['Authorization'] = request()->header('Authorization');
        }

        $response = HttpClient::send($method, $url, [
            'form_params' => $params,
            'headers' => $headers,
        ]);

        if ($response->serverError()) {
            return $this->error($response->json('message'), $response->status(), "microservice_error");
        }

        if ($response->clientError()) {
            return $this->error($response->json('message'), $response->status());
        }

        return $response->json();
    }

 

}
