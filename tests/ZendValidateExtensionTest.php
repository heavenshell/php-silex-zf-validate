<?php
/**
 * Silex ZendValidateExtension tests.
 *
 * PHP version 5.3
 *
 * Copyright (c) 2011-2012 Shinya Ohyanagi, All rights reserved.
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
 * @copyright (c) 2011-2012 Shinya Ohyanagi
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
 * @copyright (c) 2011-2012 Shinya Ohyanagi
 * @author    Shinya Ohyanagi <sohyanagi@gmail.com>
 * @license   New BSD License
 */
class ZendValidateExtensionTest extends WebTestCase
{
    public function createApplication()
    {
        return require dirname(__DIR__) . '/examples/index.php';
    }

    private function _client($uri, $method = 'GET')
    {
        $client = $this->createClient();
        $client->request($method, $uri);
        return $client->getResponse()->getContent();
    }

    public function testSuccessReturnTrue()
    {
        $content = $this->_client('/success');
        $this->assertSame($content, '1');
    }

    public function testAlnumShouldReturnErrorMessage()
    {
        $content = $this->_client('/alnum');
        $this->assertSame($content, "'abcd12+-' contains characters which are non alphabetic and no digits");
    }

    public function testAlphaShouldReturnErrorMessage()
    {
        $content = $this->_client('/alpha');
        $this->assertSame($content, "'abcd12' contains non alphabetic characters");
    }

    public function testBarcodeShouldReturnErrorMessage()
    {
        $content = $this->_client('/barcode');
        $this->assertSame($content, "'12345' should have a length of 13 characters");
    }

    public function testBetweenShouldReturnErrorMessage()
    {
        $content = $this->_client('/between');
        $this->assertSame($content, "'123456' is not between '0' and '5', inclusively");
    }

    public function testCallbackShouldReturnErrorMessage()
    {
        $content = $this->_client('/callback');
        $this->assertSame($content, "'value' is not valid");
    }

    public function testCreditCardShouldReturnErrorMessage()
    {
        $content = $this->_client('/creditcard');
        $this->assertSame($content, "'value' must contain only digits");
    }

    public function testDateShouldReturnErrorMessage()
    {
        $content = $this->_client('/date');
        $this->assertSame($content, "'value' does not fit the date format 'yyyy-MM-dd'");
    }

    public function testDigitShouldReturnErrorMessage()
    {
        $content = $this->_client('/digits');
        $this->assertSame($content, "'value' must contain only digits");
    }

    public function testEmailAddressShouldReturnErrorMessage()
    {
        $content = $this->_client('/emailaddress');
        $this->assertSame($content, "'example' is no valid hostname for email address 'example@example'");
    }

    public function testFloatShouldReturnErrorMessage()
    {
        $content = $this->_client('/float');
        $this->assertSame($content, "'value' does not appear to be a float");
    }

    public function testGreaterThenShouldReturnErrorMessage()
    {
        $content = $this->_client('/greaterthan');
        $this->assertSame($content, "'1' is not greater than '2'");
    }

    public function testHexShouldReturnErrorMessage()
    {
        $content = $this->_client('/hex');
        $this->assertSame($content, "'value' has not only hexadecimal digit characters");
    }

    public function testHostnameShouldReturnErrorMessage()
    {
        $content = $this->_client('/hostname');
        $this->assertSame($content, "'value' appears to be a local network name but local network names are not allowed");
    }

    public function testIbanShouldReturnErrorMessage()
    {
        $content = $this->_client('/iban');
        $this->assertSame($content, "'AT' has a false IBAN format");
    }

    public function testIdenticalShouldReturnErrorMessage()
    {
        $content = $this->_client('/identical');
        $this->assertSame($content, "The two given tokens do not match");
    }

    public function testInArrayShouldReturnErrorMessage()
    {
        $content = $this->_client('/inarray');
        $this->assertSame($content, "'val' was not found in the haystack");
    }

    public function testIntShouldReturnErrorMessage()
    {
        $content = $this->_client('/int');
        $this->assertSame($content, "'val' does not appear to be an integer");
    }

    public function testIpShouldReturnErrorMessage()
    {
        $content = $this->_client('/ip');
        $this->assertSame($content, "'localhost' does not appear to be a valid IP address");
    }

    public function testIsbnShouldReturnErrorMessage()
    {
        $content = $this->_client('/isbn');
        $this->assertSame($content, "'value' is no valid ISBN number");
    }

    public function testLessThanShouldReturnErrorMessage()
    {
        $content = $this->_client('/lessthan');
        $this->assertSame($content, "'12' is not less than '1'");
    }

    public function testNotEmptyShouldReturnErrorMessage()
    {
        $content = $this->_client('/notempty');
        $this->assertSame($content, "Value is required and can't be empty");
    }

    public function testPostCodeShouldReturnErrorMessage()
    {
        $content = $this->_client('/postcode');
        $this->assertSame($content, "'0' does not appear to be a postal code");
    }

    public function testRegExShouldReturnErrorMessage()
    {
        $content = $this->_client('/regex');
        $this->assertSame($content, "'value' does not match against pattern '/^test/'");
    }

    public function testSitemapChangefreqShouldReturnErrorMessage()
    {
        $content = $this->_client('/sitemap-changefreq');
        $this->assertSame($content, "'yesterday' is no valid sitemap changefreq");
    }

    public function testSitemapLastmodShouldReturnErrorMessage()
    {
        $content = $this->_client('/sitemap-lastmod');
        $this->assertSame($content, "'yesterday' is no valid sitemap lastmod");
    }

    public function testSitemapLocShouldReturnErrorMessage()
    {
        $content = $this->_client('/sitemap-loc');
        $this->assertSame($content, "'localhost' is no valid sitemap location");
    }

    public function testSitemapPriorityShouldReturnErrorMessage()
    {
        $content = $this->_client('/sitemap-priority');
        $this->assertSame($content, "Invalid type given. Numeric string, integer or float expected");
    }

    public function testStringLengthShouldReturnErrorMessage()
    {
        $content = $this->_client('/stringlength-priority');
        $this->assertSame($content, "'ab' is more than 1 characters long");
    }
}
