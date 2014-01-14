<?php
/**
 * Arfooo
 * 
 * @package    Arfooo
 * @copyright  Copyright (c) Arfooo Annuaire (fr) and Arfooo Directory (en)
 *             by Guillaume Hocine (c) 2007 - 2010
 *             http://www.arfooo.com/ (fr) and http://www.arfooo.net/ (en)
 * @author     Guillaume Hocine & Adrian Galewski
 * @license    http://creativecommons.org/licenses/by/2.0/fr/ Creative Commons
 */


class DatabaseModel extends Model
{
    function getTotalSize()
    {
        $totalSize = 0;

        foreach ($this->db->sqlGetAll("SHOW TABLE STATUS") as $row) {
            $totalSize += $row['Data_length'] + $row['Index_length'];
        }

        $unit = "B";

        if ($totalSize >= 1024) {
            $totalSize /= 1024;
            $unit = "KiB";
        }

        if ($totalSize >= 1024) {
            $totalSize /= 1024;
            $unit = "MiB";
        }

        return round($totalSize, 1) . " " . $unit;
    }

    function optimize()
    {
        foreach ($this->db->sqlGetAll("SHOW TABLES") as $row) {
            $table = current($row);
            $row = $this->db->sqlGet("OPTIMIZE TABLE $table");
        }
    }

    function createBackup($outputMethod = "txt", $action = "download")
    {
        $date = date("Y-m-d H-i-s");
        $backupSqlCode = "# Database backup $date";

        foreach ($this->db->sqlGetAll("SHOW TABLES") as $row) {
            $table = current($row);

            $backupSqlCode .= "\n\n# -- $table structure ---\n\n";
            $backupSqlCode .= "DROP TABLE IF EXISTS $table;\n";
            $createRow = $this->db->sqlGet("SHOW CREATE TABLE $table");
            $createTableSql = $createRow['Create Table'];

            $backupSqlCode .= $createTableSql . ";\n\n";

            $res = $this->db->sqlQuery("SELECT * FROM $table");
            $linesCount = $this->db->sqlNumRows($res);

            if ($linesCount) {
                $backupSqlCode .= "INSERT INTO $table VALUES";

                while ($dataRow = $this->db->sqlFetchArray($res)) {
                    $linesCount--;
                    $dataRow = array_map("mysql_real_escape_string", $dataRow);
                    $dataLine = "('" . implode("', '", $dataRow) . "')";
                    if ($linesCount) {
                        $dataLine .= ",";
                    }
                    $backupSqlCode .= $dataLine;
                }

                $backupSqlCode .= ";";
            }
        }

        $fileName = "backup-" . $date . "." . $outputMethod;

        if ($outputMethod == "gz") {
            $backupSqlCode = gzencode($backupSqlCode);
        }

        if (strpos($action, "store") !== false) {
            $fp = fopen(CODE_ROOT_DIR . "save/" . $fileName, "w");
            fwrite($fp, $backupSqlCode);
            fclose($fp);
        }

        if (strpos($action, "download") !== false) {
            header("Content-type: application/octet-stream");
            header("Content-Disposition: attachment; filename=\"$fileName\"");
            header("Content-length: " . strlen($backupSqlCode));
            echo $backupSqlCode;
        }
    }

    function sqlQuery($sql)
    {
        $this->db->sqlQuery($sql);
    }
}
