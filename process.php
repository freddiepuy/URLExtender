<?php
/**
 * Expand short urls
 *
 * @param <string> $url - Short url
 * @return <string> - Longer version of the short url
 */

extract($_POST); //Extracting the data being passed from the JSON

/* function expand_url($url)
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

// For readability
function test_expand_url($short_url)
{
    return $actual_long_url = expand_url($short_url);
} */

function expand_url($url)
{
    $ch = curl_init();

    // Set the initial shortened URL
    curl_setopt($ch, CURLOPT_URL, $url);

    // Set User-Agent to simulate a real browser
    curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36");


    // Follow any "Location" headers that cause redirects
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

    // Don't output the content, just get the final URL
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);


    // Execute the request
    curl_exec($ch);

    // Get the final effective URL after following redirects
    $expanded_url = curl_getinfo($ch, CURLINFO_EFFECTIVE_URL);

    // Close the cURL session
    curl_close($ch);

    return $expanded_url;
}


if (isset($_POST['url'])) {
    $expanded = expand_url($url); 
    $status = true;
    $testExpand = '';
    $testUrl = '';

    // Stripping the https:// prefix for the comparison condition
    if(str_contains($url, 'https://')){
        $testExpand = str_replace('https://', '', $expanded);
        $testUrl = str_replace('https://', '', $url);
    }else{
        $testExpand = str_replace('http://', '', $expanded);
        $testUrl = $url;
    }

    // Checking if the url is expanded
    if ($testExpand == $testUrl) {
        $status = false;
    } else {
        $status = true;
    }

    // Initialize the JSON array of the data to be returned
    $data = array(
        'url' => $expanded,
        'status' => $status
    );

    // Returning the encoded data
    echo json_encode($data);
} else {
    $response['status'] = 200;
    $response['message'] = "Invalid or data not found";
}


?>