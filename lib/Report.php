<?php

namespace EzSystems\EzFlowMigrationToolkit;

class Report
{
    private static $filename = 'src/MigrationBundle/migration.log';
    
    private static $formatter;
    
    private static $output;
    
    public static function prepare($output, $formatter)
    {
        self::$output = $output;
        self::$formatter = $formatter;
    }
    
    public static function write($message)
    {
        $time = date('H:i:s');
        $message = "[{$time}] {$message}";
        
        file_put_contents(self::$filename, "{$message}\r\n", FILE_APPEND);
        
        self::$output->writeln(self::$formatter->formatSection('Migration', $message));
    }
}