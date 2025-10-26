<?php
// PHP Configuration Diagnostic Script
// This script shows current PHP settings for troubleshooting upload issues
// Remove this file after diagnosis for security

echo "<h1>PHP Configuration Diagnostic</h1>";
echo "<h2>Current Upload Settings</h2>";

$settings = [
    'upload_max_filesize' => ini_get('upload_max_filesize'),
    'post_max_size' => ini_get('post_max_size'),
    'max_file_uploads' => ini_get('max_file_uploads'),
    'max_execution_time' => ini_get('max_execution_time'),
    'max_input_time' => ini_get('max_input_time'),
    'memory_limit' => ini_get('memory_limit'),
    'file_uploads' => ini_get('file_uploads') ? 'Enabled' : 'Disabled',
    'max_input_vars' => ini_get('max_input_vars'),
];

echo "<table border='1' cellpadding='5' cellspacing='0'>";
echo "<tr><th>Setting</th><th>Current Value</th><th>Recommended</th><th>Status</th></tr>";

$recommendations = [
    'upload_max_filesize' => '200M',
    'post_max_size' => '200M',
    'max_file_uploads' => '50',
    'max_execution_time' => '900',
    'max_input_time' => '900',
    'memory_limit' => '1024M',
    'file_uploads' => 'Enabled',
    'max_input_vars' => '3000',
];

foreach ($settings as $setting => $value) {
    $recommended = $recommendations[$setting];
    $status = 'OK';
    
    if ($setting === 'upload_max_filesize' || $setting === 'post_max_size') {
        $currentBytes = return_bytes($value);
        $recommendedBytes = return_bytes($recommended);
        if ($currentBytes < $recommendedBytes) {
            $status = 'NEEDS INCREASE';
        }
    } elseif ($setting === 'max_execution_time' || $setting === 'max_input_time') {
        if ((int)$value < (int)$recommended) {
            $status = 'NEEDS INCREASE';
        }
    } elseif ($setting === 'memory_limit') {
        $currentBytes = return_bytes($value);
        $recommendedBytes = return_bytes($recommended);
        if ($currentBytes < $recommendedBytes) {
            $status = 'NEEDS INCREASE';
        }
    } elseif ($setting === 'file_uploads') {
        if ($value !== 'Enabled') {
            $status = 'NEEDS ENABLE';
        }
    }
    
    $statusColor = $status === 'OK' ? 'green' : 'red';
    echo "<tr>";
    echo "<td><strong>$setting</strong></td>";
    echo "<td>$value</td>";
    echo "<td>$recommended</td>";
    echo "<td style='color: $statusColor; font-weight: bold;'>$status</td>";
    echo "</tr>";
}

echo "</table>";

echo "<h2>Server Information</h2>";
echo "<p><strong>PHP Version:</strong> " . phpversion() . "</p>";
echo "<p><strong>Server Software:</strong> " . $_SERVER['SERVER_SOFTWARE'] . "</p>";
echo "<p><strong>Document Root:</strong> " . $_SERVER['DOCUMENT_ROOT'] . "</p>";

echo "<h2>Current Error Details</h2>";
echo "<p><strong>Content-Length:</strong> 15,212,356 bytes (15.2 MB)</p>";
echo "<p><strong>Required post_max_size:</strong> At least 200M</p>";
echo "<p><strong>Current post_max_size:</strong> " . ini_get('post_max_size') . "</p>";

function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val)-1]);
    $val = (int)$val;
    
    switch($last) {
        case 'g':
            $val *= 1024;
        case 'm':
            $val *= 1024;
        case 'k':
            $val *= 1024;
    }
    
    return $val;
}

echo "<h2>Recommendations</h2>";
echo "<ol>";
echo "<li>Increase post_max_size to at least 200M</li>";
echo "<li>Increase upload_max_filesize to at least 200M</li>";
echo "<li>Increase max_execution_time to at least 900 seconds</li>";
echo "<li>Increase memory_limit to at least 1024M</li>";
echo "<li>Contact your hosting provider if you cannot change these settings</li>";
echo "</ol>";

echo "<p><strong>Note:</strong> Remove this file after diagnosis for security reasons.</p>";
?>
