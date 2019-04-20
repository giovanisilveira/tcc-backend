<?php
namespace Tcc\Controllers;

use Respect\Rest\Routable;

class MobileAppController implements Routable {
    public function get() {
        if (empty($_GET['appId']))
            $_GET['appId'] = "app";

        header('Content-Type: application/vnd.android.package-archive');
        header('Content-Disposition: attachment; filename="' . $_GET['appId'] . '.apk"');
        $file = rtrim(getcwd(),"/")."/app/" . $_GET['appId'] . ".apk";
        echo file_get_contents($file);
    }
}
