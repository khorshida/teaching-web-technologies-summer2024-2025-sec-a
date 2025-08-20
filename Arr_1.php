<?php

$numbers = array(10, 25, 30, 45, 50, 65, 70, 85, 90, 100);

$search_element = 45;

$found = false;   


foreach ($numbers as $value) {
    if ($value == $search_element) {
        $found = true;
        break;
    }
}


if ($found) {
    echo "Element $search_element is FOUND in the array.";
} else {
    echo "Element $search_element is NOT FOUND in the array.";
}

echo "<br><br>";


$found = false;
for ($i = 0; $i < count($numbers); $i++) {
    if ($numbers[$i] == $search_element) {
        $found = true;
        $position = $i;
        break;
    }
}


if ($found) {
    echo "Element $search_element is FOUND at position $position (index $position).";
} else {
    echo "Element $search_element is NOT FOUND in the array.";
}

echo "<br><br>";


$occurrences = array();
$search_element2 = 30;

for ($i = 0; $i < count($numbers); $i++) {
    if ($numbers[$i] == $search_element2) {
        $occurrences[] = $i; 
    }
}

if (!empty($occurrences)) {
    echo "Element $search_element2 found at positions: " . implode(", ", $occurrences);
} else {
    echo "Element $search_element2 not found in the array.";
}
?>