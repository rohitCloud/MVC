<?php
/**
 * Created by Rohit Arora
 */

namespace Application\Controllers;

use Base\Controllers\BaseController;

/**
 * Class GenerateCSV
 * @package Application\Controllers
 */
class GenerateCSV extends BaseController
{
    public function index()
    {
        ob_start();
        header('Content-Type: text/html; charset=utf-8');
        $file = file('sample.txt');
        $list = [];
        for ($i = 0; $i < count($file); $i++) {
            foreach (['फोटो', 'उपलब्ध', 'है।', 'नाम :', 'मकान', 'आयु', 'अनुभाग', 'नामावली'] as $needel) {
                $pos = strpos($file[$i], $needel);
                if ($pos !== false) {
                    $list[] = $i;
                }
            }
        }
        foreach ($list as $key) {
            unset($file[$key]);

        }
        $file = array_values($file);
        for ($i = 1; $i < count($file); $i++) {
            $page[] = trim($file[$i]);
            if (($i % 8) == 0) {
                $page = array_values($page);
                $users[] = $page;
                $page = [];
            }
        }

        $fp = fopen('file2.csv', 'w');

        foreach ($users as $fields) {
            unset($fields[0]);
            unset($fields[7]);
            fputcsv($fp, $fields);
        }

        fclose($fp);

    }
}