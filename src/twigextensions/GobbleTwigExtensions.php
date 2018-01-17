<?php
/**
 * Gobble plugin for Craft 3
 *
 * A simple plugin for sending REST API requests directly from your templates.
 *
 * @link      https://www.jfd.co.uk
 * @copyright Copyright (c) 2018 James Ford Design
 */

namespace jfd\gobble\twigextensions;

use Craft;
use \Twig_Extension;
use GuzzleHttp\Client;
use jfd\gobble\Gobble;

/**
 * @author    JFD
 * @package   Gobble
 * @since     1.0.0
 */
class GobbleTwigExtensions extends \Twig_Extension
{
    /**
     * Returns the name of the extension.
     *
     * @return string The extension name
     */
    public function getName()
    {
        return 'Gobble';
    }

    /**
     * Make the function(s) available in the templates
     *
    * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('gobble', [$this, 'gobble']),
        ];
    }

    /**
     * Makes a request to the API
     *
     * @param array $request    Request URL, method, headers, etc.
     *
     * @return array
     */
    public function gobble($request)
    {
        // Check that at least 'url' and 'method' have been provided
        if( !array_key_exists('url', $request) || !array_key_exists('method', $request) ) {
            return false;
        }

        // Get the optional data from the request array and stick it in an array to pass to the request
        $requestOptions = [];

        if( array_key_exists('auth', $request) ) {
            $requestOptions['auth'] = $request['auth'];
        }

        if( array_key_exists('body', $request) ) {
            $requestOptions['body'] = $request['body'];
        }

        if( array_key_exists('headers', $request) ) {
            $requestOptions['headers'] = $request['headers'];
        }

        if( array_key_exists('query', $request) ) {
            $requestOptions['query'] = $request['query'];
        }

        if( array_key_exists('json', $request) && !array_key_exists('body', $request) ) {
            $requestOptions['json'] = $request['json'];
        }

        // Create a new Guzzle client
        $client = new Client();

        // Send the API request
        $response = $client->request($request['method'], $request['url'], $requestOptions);

        // Get the response body
        $body = $response->getBody()->getContents();

        // Create array to send back to template
        $output = [
            'statusCode' => $response->getStatusCode(),
            'reasonPhrase' => $response->getReasonPhrase(),
            'body' => $this->isJSON($body) ? json_decode($body) : $body
        ];

        // Return output to template
        return $output;
    }

    /**
     * Determine if a string is JSON
     *
     * @param string $string    The string to be checked
     *
     * @return boolean
     */
    private function isJSON($string){
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }
}
