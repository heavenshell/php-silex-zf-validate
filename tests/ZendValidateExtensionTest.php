<?php
/**
 * Silex ZendValidateExtension tests.
 *
 * PHP version 5.3
 *
 * Copyright (c) 2011 Shinya Ohyanagi, All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *   * Redistributions of source code must retain the above copyright
 *     notice, this list of conditions and the following disclaimer.
 *
 *   * Redistributions in binary form must reproduce the above copyright
 *     notice, this list of conditions and the following disclaimer in
 *     the documentation and/or other materials provided with the
 *     distribution.
 *
 *   * Neither the name of Shinya Ohyanagi nor the names of his
 *     contributors may be used to endorse or promote products derived
 *     from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS
 * FOR A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE
 * COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT,
 * INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING,
 * BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER
 * CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT
 * LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN
 * ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 *
 * @use       \Silex
 * @category  \Silex
 * @package   \Silex\Extensions
 * @version   $id$
 * @copyright (c) 2011 Shinya Ohyanagi
 * @author    Shinya Ohyanagi <sohyanagi@gmail.com>
 * @license   New BSD License
 */

require_once 'prepare.php';

use Silex\WebTestCase;

/**
 * Zend_Validate Test.
 *
 * @use       \Silex
 * @category  \Silex
 * @package   \Silex\Extensions
 * @version   $id$
 * @copyright (c) 2011 Shinya Ohyanagi
 * @author    Shinya Ohyanagi <sohyanagi@gmail.com>
 * @license   New BSD License
 */
class ZendValidateExtensionTest extends WebTestCase
{
    public function createApplication()
    {
        require dirname(__DIR__) . '/examples/index.php';
        return $app;
    }

    public function testAlnumShouldReturnErrorMessage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/alnum');
        $content = $client->getResponse()->getContent();
        $this->assertSame($content, "'abcd12+-' contains characters which are non alphabetic and no digits");
    }

    public function testAlphaShouldReturnErrorMessage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/alpha');
        $content = $client->getResponse()->getContent();
        $this->assertSame($content, "'abcd12' contains non alphabetic characters");
    }

    public function testBarcodeShouldReturnErrorMessage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/barcode');
        $content = $client->getResponse()->getContent();
        $this->assertSame($content, "'12345' should have a length of 13 characters");
    }

    public function testBetweenShouldReturnErrorMessage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/between');
        $content = $client->getResponse()->getContent();
        $this->assertSame($content, "'123456' is not between '0' and '5', inclusively");
    }

    public function testCallShouldReturnErrorMessage()
    {
        $client  = $this->createClient();
        $crawler = $client->request('GET', '/callback');
        $content = $client->getResponse()->getContent();
        $this->assertSame($content, "'value' is not valid");
    }
}
