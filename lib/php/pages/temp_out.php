<?php
if (count($output_data) == 0) {
    echo "Ничего не найдено";
    return;
}
$html = "";
$html .= "<table class='table table-condensed table-hover'>";

foreach ($output_data as $row) {
    $html .= "<tr>";
    if (count($row) == 0) {
        echo "Ничего не найдено";
        return;
    }
    foreach ($row as $field) {
        $html .= "<td>$field</td>";
    }
    $html .= "</tr>";
}

$html .= "</table>";

echo $html;

?>