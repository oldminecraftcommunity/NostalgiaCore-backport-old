<?php

class GlassPaneBlock extends TransparentBlock{
	public function __construct(){
		parent::__construct(GLASS_PANE, 0, "Glass Pane");
		$this->isFullBlock = false;
		$this->isSolid = false;
	}

	public static function getCollisionBoundingBoxes(Level $level, $x, $y, $z, Entity $entity){
		$var8 = self::canConnectTo($level->level->getBlockID($x, $y, $z - 1));
		$var9 = self::canConnectTo($level->level->getBlockID($x, $y, $z + 1));
		$var10 = self::canConnectTo($level->level->getBlockID($x - 1, $y, $z));
		$var11 = self::canConnectTo($level->level->getBlockID($x + 1, $y, $z));
		$aabb = new AxisAlignedBB($x, $y, $z, $x, $y, $z);
		$arr = [];
		if((!$var10 || !$var11) && ($var10 || $var11 || $var8 || $var9)){
			if($var10 && !$var11) $arr[] = $aabb->addMinMax(0, 0, 0.4375, 0.5, 1, 0.5625);
			elseif(!$var10 && $var11) $arr[] = $aabb->addMinMax(0.5, 0, 0.4375, 1, 1, 0.5625);
		}else{
			$arr[] = $aabb->addMinMax(0, 0, 0.4375, 1, 1, 0.5625);
		}

		if((!$var8 || !$var9) && ($var10 || $var11 || $var8 || $var9)){
			if($var8 && !$var9) $arr[] = $aabb->addMinMax(0.4375, 0, 0, 0.5625, 1, 0.5);
			elseif(!$var8 && $var9) $arr[] = $aabb->addMinMax(0.4375, 0, 0.5, 0.5625, 1, 1);
		}else{
			$arr[] = $aabb->addMinMax(0.4375, 0, 0, 0.5625, 1, 1);
		}
		return $arr;
	}

	public static function canConnectTo($blockID) : bool{
		return StaticBlock::getIsSolid($blockID) || $blockID == GLASS;
	}

	public function getDrops(Item $item, Player $player){
		return array(
			array(GLASS_PANE, 0, 0),
		);
	}
}