<?php

/* 
This is just an area to test some codeblocks
*/
$ch = curl_init();

// Set the initial shortened URL
curl_setopt($ch, CURLOPT_URL, "rb.gy/2l0aqe");

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

// Output the final expanded URL
echo "Expanded URL: " . $expanded_url;
?>