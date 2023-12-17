<?php
declare(strict_types=1);

namespace MeowBlog\Services;

use Cake\Core\Configure;
use OpenAI;
use OpenAI\Client;

class OpenaiChatService implements OpenaiChatServiceInterface
{
    protected Client $client;

    /**
     * Return Client
     *
     * @return Client
     */
    protected function getClient(): Client
    {
        if (!isset($this->client)) {
            $this->client = OpenAI::client(Configure::read('MeowBlog.openai_api_key'));
        }

        return $this->client;
    }

    /**
     * @param string $text Text
     * @return string
     */
    public function getTextSummary(string $text): string
    {
        // create config for OpenAi sumarize givent test
        $config =[
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Write a blog post summary of 100 words or less: ' . $text,
                ]
            ],
        ];

        $result = $this->getClient()->chat()->create($config);

        return $result->choices[0]->message->content;
    }
}