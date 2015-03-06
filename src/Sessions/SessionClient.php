<?php

namespace TheMarketingLab\Hg\Sessions;

use TheMarketingLab\Hg\AbstractClient;

class SessionClient extends AbstractClient implements SessionClientInterface
{


    public function getSession(SessionInterface $session)
    {
        $test = $session->getTest();
        if ($test !== null) {
            $body = array('id' => $test->getId(), 'variant' => $test->getVariant());
        }
        $uri = 'sessions/' . $session->getId();
        $request = $this->getClient()->createRequest('GET', $uri, array(), isset($body) ? $body : null, array());
        $response = $request->send();
        $data = $response->json();

        if ($data !== null) {
            $returnedTest = new Test($data['id'], $data['variant']);
            $session->addTest($returnedTest);
        }

        return $session;
    }
}
