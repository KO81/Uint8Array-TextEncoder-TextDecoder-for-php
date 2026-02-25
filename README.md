# Uint8Array-TextEncoder-TextDecoder-for-php
Uint8Array, TextEncoder  (binary-safe)  and TextDecoder (binary-safe) similar to WEBapi  but written for php. 


Use Cases

    Binary Data Storage - Store binary data in databases as byte arrays

    Network Communication - Prepare data for binary protocols

    Encryption - Work with byte-level encryption algorithms

    File Processing - Handle binary file formats

    Cross-language Compatibility - Match JavaScript TypedArray behavior

    Character Encoding Conversion - Convert between different text encodings

Browser/Node.js Compatibility

This library mimics the Web API behavior, making it ideal for:

    Porting JavaScript code to PHP

    Building isomorphic applications

    Working with WebSocket binary data

    Handling File API data in PHP backends

Performance Notes

    TextEncoder uses binary conversion internally, best for general use

    TextEncoderUTF8 uses hex encoding, better for UTF-8 specific operations

    All operations are memory-efficient, processing data in chunks

Contributing

Feel free to submit issues and enhancement requests!
License

MIT License - feel free to use in personal and commercial projects
Author

Created for binary-safe string handling in PHP, inspired by the Web Crypto API and JavaScript TypedArrays.


require_once 'Uint8Array.TextEncoder.TextDecoder.php';

// Encode a string to Uint8Array
$encoder = new TextEncoder();
$uint8 = $encoder->encode("Hello World");

// Access the byte array
print_r($uint8->array); // [72, 101, 108, 108, 111, 32, 87, 111, 114, 108, 100]
echo $uint8->buffer;    // "72,101,108,108,111,32,87,111,114,108,100"
echo $uint8->length;    // 11

// Decode back to string
$decoder = new TextDecoder();
$text = $decoder->decode($uint8);
echo $text; // "Hello World"

$array = new Uint8Array([72, 101, 108, 108, 111]);
$array = new Uint8Array([], 10); // Create zero-filled array of length 10

// Properties
$array->array   // The byte array
$array->buffer  // Comma-separated string of bytes
$array->length  // Array length

sB($string)  // Convert string to binary string (8 bits per character)
sT($binary)  // Convert binary string back to string

// Examples
$binary = sB("A");           // "01000001"
$char = sT("01000001");      // "A"

num($binary, $base = 2)      // Binary string to decimal
str($decimal, $base = 2)     // Decimal to binary string

// Examples
$decimal = num("1010");      // 10
$binary = str(10);           // "1010"

Advanced Usage
Binary-Safe String Processing

// Handle any Unicode character
$text = "Hello 🌍 世界 𠮷";

// Encode to bytes
$encoder = new TextEncoder();
$bytes = $encoder->encode($text);

// Process bytes (example: add 1 to each byte)
foreach($bytes->array as &$byte) {
    $byte = ($byte + 1) % 256;
}

// Decode back
$decoder = new TextDecoder();
$processed = $decoder->decode($bytes);
echo $processed; // Original text with bytes shifted

Working with Custom Encoding

// Create your own encoding wrapper
function customEncode($text, $key) {
    $encoder = new TextEncoder();
    $bytes = $encoder->encode($text);
    
    // Simple XOR encryption
    foreach($bytes->array as $i => $byte) {
        $bytes->array[$i] = $byte ^ ord($key[$i % strlen($key)]);
    }
    
    return $bytes;
}

function customDecode($bytes, $key) {
    // Reverse XOR
    foreach($bytes->array as $i => $byte) {
        $bytes->array[$i] = $byte ^ ord($key[$i % strlen($key)]);
    }
    
    $decoder = new TextDecoder();
    return $decoder->decode($bytes);
}

// Usage
$encrypted = customEncode("Secret message", "key");
$decrypted = customDecode($encrypted, "key");
