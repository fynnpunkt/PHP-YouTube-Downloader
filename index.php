<?php
if (isset($_POST['url'])) {
    $url = $_POST['url'];
    $output = downloadVideo($url);
    echo $output;
}

function downloadVideo($url) {
    $outputDir = __DIR__ . '/downloads/';
    if (!is_dir($outputDir)) {
        mkdir($outputDir, 0777, true);
    }

    $filename = uniqid() . '.mp4';
    $filePath = $outputDir . $filename;

    $command = escapeshellcmd("youtube-dl -o " . escapeshellarg($filePath) . " " . escapeshellarg($url));
    $output = shell_exec($command);

    if (file_exists($filePath)) {
        return "Erfolgreich heruntergeladen: <a href='downloads/$filename'>Herunterladen</a>";
    } else {
        return "Fehler beim Herunterladen des Videos.";
    }
}
?>

<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>YouTube Downloader</title>
</head>
<body>
<form method="post">
    <label for="url">URL:</label>
    <input type="text" id="url" name="url" required>
    <button type="submit">Herunterladen</button>
</form>
</body>
</html>
