<?php


class File
{
    public static function readFile(string $file):array
    {
        $file = fopen($file, "r");
        $contents = [];
        while (!feof($file)) {
            $line = fgets($file);
            $patt = '/\b[a-zA-Z]+\b/';

            preg_match_all($patt, $line, $res);
//            var_dump($res);
//            $lineWords = explode(' ', trim($line));
            foreach ($res[0] as $word) {
                if (!empty($word)) {
                    $contents[] = strtolower($word);
                }
            }
        }

        fclose($file);

        return $contents;
    }
}
