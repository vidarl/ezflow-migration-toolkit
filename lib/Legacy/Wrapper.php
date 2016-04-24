<?php

namespace EzSystems\EzFlowMigrationToolkit\Legacy;

use EzSystems\EzFlowMigrationToolkit\Exception\MigrationException;
use EzSystems\EzFlowMigrationToolkit\UUID;

final class Wrapper
{
    static private $initialized = false;

    static private $path = null;
    
    static private $configs = null;
    
    static private $uuidSeed = null;
    
    static public $handler;
    
    static public function getUuidSeed()
    {
        return self::$uuidSeed;
    }

    static public function initialize($path, $configs)
    {
        if (self::$initialized) {
            throw new MigrationException('Legacy wrapper already initialized');
        }

        self::$path = $path;
        self::$configs = $configs;
        self::$uuidSeed = UUID::v4();

        $legacyClasses = [
            'eZDir' => [$path, 'lib', 'ezfile', 'classes', 'ezdir.php'],
            'eZFile' => [$path, 'lib', 'ezfile', 'classes', 'ezfile.php'],
            'eZLog' => [$path, 'lib', 'ezfile', 'classes', 'ezlog.php'],
            'eZTextCodec' => [$path, 'lib', 'ezi18n', 'classes', 'eztextcodec.php'],
            'eZCharsetInfo' => [$path, 'lib', 'ezi18n', 'classes', 'ezcharsetinfo.php'],
            'eZSys' => [$path, 'lib', 'ezutils', 'classes', 'ezsys.php'],
            'eZDebug' => [$path, 'lib', 'ezutils', 'classes', 'ezdebug.php'],
            'eZIni' => [$path, 'lib', 'ezutils', 'classes', 'ezini.php'],
        ];

        array_walk($legacyClasses, function (&$path) {
            $path = implode(DIRECTORY_SEPARATOR, $path);
        });

        foreach ($legacyClasses as $class) {
            require_once($class);
        }

        self::$initialized = true;
    }

    public function __construct()
    {
        if (!self::$initialized) {
            throw new MigrationException('Legacy wrapper not initialized');
        }
    }

    public function getBlockConfiguration()
    {
        $iniFile = new \eZINI('block.ini', 'extension/ezflow/settings', null, false, true);
        
        foreach (self::$configs as $config) {
            $iniFile->parseFile(self::$path . '/' . $config);
        }
        
        return $iniFile->getNamedArray();
    }
}