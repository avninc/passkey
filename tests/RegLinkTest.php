<?php

namespace Passkey\Tests;

use Passkey\Common\AWS;
use Passkey\Common\Profile;
use Passkey\Common\Endpoint;
use Passkey\Common\Security;
use Passkey\Connector\RegLink;
use PHPUnit\Framework\TestCase;

class RegLinkTest extends TestCase
{
    public function test_can_init_class()
    {
        $security = new Security('reglinkapi', 'passkey1', 136260);
        $profile = new Profile($security, [
            'FirstName' => 'Vincent',
            'LastName' => 'Gabriel',
            'EventID' => 146021,
            'EventCode' => 'RTEATT0117',
            'OP' => 'CreateBridgeHTTP',
            'ExtReferenceID' => 1,
            'EmailAddress' => 'test@test.com'
        ]);
        $endpoint = new Endpoint(true);
        $reg = new RegLink($endpoint, $profile);
        try {
            $post = $reg->post();
        } catch(\Exception $e) {
            echo $e->getMessage();
            return;
        }
        
        $this->assertNotNull($post);

        if($reg->getIsSuccess()) {
            $this->assertNotNull($reg->getBridgeId());
            $aws = new AWS($reg->getBridgeId(), 146021);
        } else {
            echo $reg->getErrorMessage();
            return;
        }        
    }
}
