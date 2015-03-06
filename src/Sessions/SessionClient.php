<?php

namespace TheMarketingLab\Hg\Sessions;

use TheMarketingLab\Hg\AbstractClient;

class SessionClient extends AbstractClient implements SessionClientInterface
{


    public function getSession($id, TestInterface $test = null)
    {
        if ($test !== null) {
            $body = array('id' => $test->getId(), 'variant' => $test->getVariant());
        }
        $uri = 'sessions/' . $id;
        $request = $this->getClient()->createRequest('GET', $uri, array(), isset($body) ? $body : null, array());
        $response = $request->send();
        $data = $response->json();

        $returnedTest = null;
        if (isset($data['test'])) {
            $returnedTest = new Test($data['test']['id'], $data['test']['variant']);
        }

        $session = new Session($id, $returnedTest);
        return $session;
    }
}
