<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 2/03/2018
 * Time: 10:25 PM
 */

if (!function_exists('list_files')) {
    /**
     * list all files within a given path
     *
     * @param $base_path
     * @param bool $recursive
     * @return array
     */
    function list_files($base_path, $recursive = false)
    {
        if ($recursive === false) {
            $directories = \File::files($base_path);
            $results = [];
            foreach ($directories as $directory) {
                $results[] = array_get(pathinfo($directory), 'filename');
            }
        } else {
            $directories = list_directories($base_path);
            $results = list_files($base_path);
            if ($recursive === true && !is_null($directories)) {
                foreach ($directories as $directory) {
                    $newBasePath = $base_path . "/{$directory}";
                    $newFiles = list_files($newBasePath, true);
                    if (!is_null($newFiles)) {
                        foreach ($newFiles as $newFile) {
                            $qualifiedFileName = "{$directory}\\{$newFile}";
                            if (!in_array($qualifiedFileName, $results)) {
                                $results[] = $qualifiedFileName;
                            }
                        }
                    }
                }
            }
        }
        return $results;
    }
}

if (!function_exists('list_directories')) {
    /**
     * list all directories within a given path (no recursive)
     *
     * @param $base_path
     * @return array
     */
    function list_directories($base_path)
    {
        $directories = \File::directories($base_path);
        $results = [];
        foreach ($directories as $directory) {
            $results[] = array_get(pathinfo($directory), 'filename');
        }
        return $results;
    }
}

if (!function_exists('array_to_csv')) {
    /**
     * Convert an arry to CSV file content string
     *
     * @param array $input
     * @param string $delimiter
     * @param string $enclosure
     * @return string
     */
    function array_to_csv(array $input, $delimiter = ',', $enclosure = '"')
    {
        $fp = fopen('php://temp', 'r+');
        if (is_array(array_first($input))) {
            foreach ($input as $subInput) {
                fputcsv($fp, $subInput, $delimiter, $enclosure);
            }
        } else {
            fputcsv($fp, $input, $delimiter, $enclosure);
        }
        rewind($fp);
        $data = fread($fp, 1048576);
        fclose($fp);
        return rtrim($data, "\n");
    }
}