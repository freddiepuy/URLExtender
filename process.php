<?php
/**
 * Expand short urls
 *
 * @param <string> $url - Short url
 * @return <string> - Longer version of the short url
 */

extract($_POST);

function expand_url($url)
{
    //Get response headers
    $response = get_headers($url, 1);
    //Get the location property of the response header. If failure, return original url
    if (array_key_exists('Location', $response)) {
        $location = $response["Location"];
        if (is_array($location)) {
            // t.co gives Location as an array
            return expand_url($location[count($location) - 1]);
        } else {
            return expand_url($location);
        }
    }
    return $url;
}

/**
 * Test Short urls
 */
function test_expand_url($short_url)
{
    return $actual_long_url = expand_url($short_url);
}

if (isset($_POST['url'])) {
    $expanded = test_expand_url($url);
    $status = true;
    if ($expanded == $url) {
        $status = false;
    } else {
        $status = true;
    }
    $data = array(
        'url' => $expanded,
        'status' => $status
    );

    echo json_encode($data);
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid or data not found";
}

// Run testcases 

?>