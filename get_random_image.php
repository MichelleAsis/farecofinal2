<?php
if (isset($_GET['type'])) {
    $type = $_GET['type'];
    $directory = '';

    switch ($type) {
        case 'pant':
            $directory = 'defaultimg/pant/';
            break;
        case 'shorts':
            $directory = 'defaultimg/short/';
            break;
        case 'skirts':
            $directory = 'defaultimg/skirt/';
            break;
        case 'shirt':
            $directory = 'defaultimg/top/';
            break;
        default:
            echo json_encode(['error' => 'Invalid type']);
            exit;
    }

    $images = glob($directory . '*.{jpg,png,gif}', GLOB_BRACE);

    if (count($images) > 0) {
        $randomImage = $images[array_rand($images)];
        echo json_encode(['image' => $randomImage]);
    } else {
        echo json_encode(['error' => 'No images found']);
    }
} else {
    echo json_encode(['error' => 'No type specified']);
}
?>
