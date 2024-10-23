<?php
/**
* Expand short urls
*
* @param <string> $url - Short url
* @return <string> - Longer version of the short url
*/
function expand_url($url){
    //Get response headers
    $response = get_headers($url, 1);
    //Get the location property of the response header. If failure, return original url
    if (array_key_exists('Location', $response)) {
        $location = $response["Location"];
        if (is_array($location)) {
            // t.co gives Location as an array
            return expand_url($location[count($location) - 1]);
        } else {
            return expand_url($location)
        }
    }
    return "<h1>Expanded URL: <h4>{$url}</h4></h1>";
}

/**
 * Test Short urls
 */
function test_expand_url($short_url) {
    return $actual_long_url = expand_url($short_url);
    // if ($actual_long_url == $expected_long_url) {
    //     return "Pass for $short_url <br>";
    // } else {
    //     return "Fail for $short_url <br>";
    // }
}

// Run testcases 
echo test_expand_url(short_url: 'https://youtu.be/_MlYUgZnZcU');
?>