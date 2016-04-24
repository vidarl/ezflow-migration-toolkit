<?php

namespace EzSystems\EzFlowMigrationToolkit\HelperObject;

class Zone
{
    private $id;
    
    private $blocks = [];
    
    private $blockMapper;
    
    public function __construct($zone, $blockMapper)
    {
        $this->blockMapper = $blockMapper;
        $this->id = $zone['zone_identifier'];
        
        if (isset($zone['block'])) {
            $blocks = $zone['block'];
           
            // Single block
            if (isset($blocks['type'])) {
                $blocks = [$blocks];
            }
            
            foreach ($blocks as $legacyBlock) {
                $block = new Block($legacyBlock, $blockMapper);
                
                $this->blocks[] = $block;
            }
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getBlockMapper()
    {
        return $this->blockMapper;
    }
    
    public function getBlocks()
    {
        return $this->blocks;
    }
}