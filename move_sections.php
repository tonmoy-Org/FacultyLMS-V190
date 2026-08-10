<?php
$file = 'resources/views/frontend/course/course_details.blade.php';
$lines = file($file);

// Section 10 starts at line 489 (0-indexed: 488), which is the {{-- comment line
// Section 11 ends before Section 12 which starts at line 664 (0-indexed: 663)
// Section 12 comment line = 664 (1-indexed), 0-indexed = 663

$section10StartLine = 488; // 0-indexed (line 489)
$section12StartLine = 663; // 0-indexed (line 664)

// Extract the block (lines 489-663 inclusive, 0-indexed 488-662)
$blockLines = array_splice($lines, $section10StartLine, $section12StartLine - $section10StartLine);
$block = implode('', $blockLines);

// Now lines array no longer has sections 10 & 11
// Find @endif\n\n@endsection (Related Courses @endif is now at different position)
// Let's find "@endsection" to insert just before it
$content = implode('', $lines);

// Find "@endif\n\n@endsection" pattern
$marker = "@endif\r\n\r\n@endsection";
$pos = strpos($content, $marker);
if ($pos === false) {
    $marker = "@endif\n\n@endsection";
    $pos = strpos($content, $marker);
}

if ($pos === false) {
    // Try to find just @endsection
    $endsection = strpos($content, "@endsection");
    if ($endsection === false) {
        die("Cannot find @endsection");
    }
    // insert before @endsection
    $content = substr($content, 0, $endsection) . "\r\n" . $block . "\r\n" . substr($content, $endsection);
} else {
    // Insert block between @endif and @endsection
    $afterEndif = $pos + strlen("@endif\r\n\r\n");
    $content = substr($content, 0, $afterEndif) . $block . substr($content, $afterEndif);
}

file_put_contents($file, $content);
echo "Done!\n";
