<?php

namespace App\Services;

use App\Services\AbstractService;
use GuzzleHttp\Exception\ClientException;

class MailingListService extends AbstractService
{
    public function subscribe(int $mailingListId, string $email)
    {
        try {
            $this->client->rawRequest('post', 'mailinglists/' . $mailingListId . '/subscriptions/' . $email);
        } catch (ClientException $e) {
            switch ($e->getResponse()->getStatusCode()) {
                case 404:
                    throw $e;
                case 409:
                    throw $e;
                default:
                    throw $e;
            }
        }
    }
}
