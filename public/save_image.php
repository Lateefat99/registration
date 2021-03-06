<?php

use Illuminate\Support\Facades\Storage;

$folder = "studentsPictures";
$destinationFolder = $_SERVER['DOCUMENT_ROOT'] . '/studentsPictures/' ; // you may need to adjust to your server configuration
$maxFileSize = 2 * 1024 * 1024;

// Get the posted data
$postdata = file_get_contents("php://input");

if (!isset($postdata) || empty($postdata))
    exit(json_encode(["success" => false, "reason" => "Not a post data"]));

// Extract the data
$request = json_decode($postdata);

// Validate
if (trim($request->data) === "")
    exit(json_encode(["success" => false, "reason" => "Not a post data"]));


$file = $request->data;
$reg_number = $request->reg_number;

// getimagesize is used to get the file extension
// Only png / jpg mime types are allowed
$size = getimagesize($file);
$ext = $size['mime'];
if ($ext == 'image/jpeg')
    $ext = '.jpg';
elseif ($ext == 'image/png')
    $ext = '.png';
else
    exit(json_encode(['success' => false, 'reason' => 'only png and jpg mime types are allowed']));

// Prevent the upload of large files
if (strlen(base64_decode($file)) > $maxFileSize)
    exit(json_encode(['success' => false, 'reason' => "file size exceeds {$maxFileSize} Mb"]));

// Remove inline tags and spaces
$img = str_replace('data:image/png;base64,', '', $file);
$img = str_replace('data:image/jpeg;base64,', '', $img);
$img = str_replace(' ', '+', $img);

// Read base64 encoded string as an image
$img = base64_decode($img);

// Give the image a unique name. Don't forget the extension
$filename = $reg_number . "-" . date("d_m_Y_H_i_s")  . $ext; //date("d_m_Y_H_i_s") . "-" . time() . $ext;

// The path to the newly created file inside the upload folder
$destinationPath = "$destinationFolder$filename";

// Create the file or return false
$success = file_put_contents($destinationPath, $img);

//Storage::put($destinationPath, $filename->stream());

if (!$success)
    exit(json_encode(['success' => false, 'reason' => 'the server failed in creating the image']));

// Inform the browser about the path to the newly created image
exit(json_encode(['success' => true, 'path' => "$folder$filename", 'file_name' => "$filename"]));
