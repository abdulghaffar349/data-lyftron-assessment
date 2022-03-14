<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ResponseResource extends JsonResource
{
    private $message, $meta, $statusCode;
    public static $wrap = null; //data will send without wrapping
    /**
     *
     * @param string $message
     * @param array $meta if there is need to add more data in response
     */
    public function __construct($message = "", array $meta = [], $statusCode = 200)
    {
        parent::__construct(null);
        $this->message = $message;
        $this->meta = $meta;
        $this->statusCode = $statusCode;
    }

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
                "message" => $this->message
            ] + $this->meta;
    }

    public function toResponse($request)
    {
        return parent::toResponse($request)->setStatusCode($this->statusCode);
    }
}
