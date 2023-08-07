<?php
// Handle feature image upload
$banner_img = $_FILES['customFile1'];
$banner_imgName = generateUniqueFilename($banner_img['name']);
$banner_imgDestination = '../images/' . $banner_imgName;
move_uploaded_file($banner_img['tmp_name'], $banner_imgDestination);

$audio_file = $_FILES['customFile2'];
$audio_fileName = generateUniqueFilename($audio_file['name']);
$audio_fileDestination = '../images/audio/' . $audio_fileName;
move_uploaded_file($audio_file['tmp_name'], $audio_fileDestination);

$title = $_POST['title'];
$categories = $_POST['categories'];
$user = $_POST['user'];

// Save filenames to the database
$pdo = new PDO('mysql:host=localhost;dbname=capstone', 'root', ''); 
$stmt = $pdo->prepare('INSERT INTO button 
(label, voice_audio, categ, icon, history, historyremove, status, user) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
$stmt->execute([$title, $audio_fileName, $categories, $banner_imgName, 1, 1, 1, $user]);

// Function to generate a unique filename
function generateUniqueFilename($filename)
{
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    return uniqid() . '.' . $extension;
}


?>