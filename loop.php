<!DOCTYPE html>
<html>
<body>
<?php

$alphabet = array_merge(
    range('a', 'z'),
    range('A', 'Z'),
    range('0', '9'),
    ['!', '@', '#', '$', '%']
);

$maxLength = 8;     // CHỈ giới hạn độ dài
$prefix    = '';    // để trống = chạy toàn bộ

$base = count($alphabet);

/**
 * Increment base-N counter
 */
function increment(array &$idx, int $base): bool
{
    for ($i = count($idx) - 1; $i >= 0; $i--) {
        if ($idx[$i] < $base - 1) {
            $idx[$i]++;
            return true;
        }
        $idx[$i] = 0;
    }
    return false;
}

// xử lý prefix (nếu có)
$prefixIdx = [];
if ($prefix !== '') {
    foreach (str_split($prefix) as $ch) {
        $pos = array_search($ch, $alphabet, true);
        if ($pos === false) {
            die("Prefix chứa ký tự không hợp lệ\n");
        }
        $prefixIdx[] = $pos;
    }
}

for ($len = max(1, count($prefixIdx)); $len <= $maxLength; $len++) {

    $idx = array_merge(
        $prefixIdx,
        array_fill(0, $len - count($prefixIdx), 0)
    );

    do {
        $word = '';
        foreach ($idx as $i) {
            $word .= $alphabet[$i];
        }

        echo $word . PHP_EOL;

    } while (increment($idx, $base));
}

?>

</body>
</html>