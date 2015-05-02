<?php
namespace URIDecoder;

use Helper\Helper as CHelper;

class Helper
{
	public static function getFolderLength() { return strlen(CHelper::getFolder()); }
}