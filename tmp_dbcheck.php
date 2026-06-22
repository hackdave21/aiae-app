<?php
$zones = DB::table('zones_irradiation')->get();
foreach ($zones as $z) { echo json_encode($z).PHP_EOL; }
