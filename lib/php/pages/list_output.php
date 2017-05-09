<?php
if (isset($output_data["price"]) && isset($output_data["time"]))
    echo $output_data["price"] ."&" . $output_data["time"];
else {
    foreach ($output_data as $tmp) {
        echo $tmp . "&";
    }
}
?>