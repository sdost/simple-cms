<?php
class XMLGenerator 
{
	static function generateCrumb($domDoc, $xmlParent, $ar)
	{
		foreach($ar as $value)
		{
			$crumb = $domDoc->createElement("crumb_item");
			$xmlParent->appendChild($crumb);
			
			$idAttr = $domDoc->createAttribute("id");
			$idValue = $domDoc->createTextNode($value['id']);
			$idAttr->appendChild($idValue);
			
			$nameAttr = $domDoc->createAttribute("name");
			$nameValue = $domDoc->createTextNode($value['name']);
			$nameAttr->appendChild($nameValue);
			
			$crumb->appendChild($idAttr);
			$crumb->appendChild($nameAttr);
		}
	}
	
    static function generateMenu($domDoc, $xmlParent)
	{
		$pages = null;
		try {
			$pages = Page::getFrontPages();
		} catch( PropertyException $pe ) {
			echo "ERROR: ".$pe->getMessage();
		} catch( MySQLException $mse ) {
			echo "ERROR: ".$mse->getMessage();
		}
		
		foreach($pages as $row)
		{
			$menuItem = $domDoc->createElement("menu_item");
			$xmlParent->appendChild($menuItem);
		
			$name = $domDoc->createElement("name");
			$menuItem->appendChild($name);
		
			$pageName = $domDoc->createTextNode($row['page_name']);
			$name->appendChild($pageName);
		
			$id = $domDoc->createElement("id");
			$menuItem->appendChild($id);
		
			$pageID = $domDoc->createTextNode($row['id']);
			$id->appendChild($pageID);
			
			$pageLink = $domDoc->createElement("link");
			$menuItem->appendChild($pageLink);
			
			$str = str_replace(" ","_",$row['page_name']);
			$str = strtolower($str);
			$linkStr = $domDoc->createTextNode($str);
			$pageLink->appendChild($linkStr);
			
			$order = $domDoc->createElement("oder");
			$menuItem->appendChild($order);
			
			$orderNum = $domDoc->createTextNode($row['front_page_order']);
			$order->appendChild($orderNum);
		}
	}
	
	static function generateContent($domDoc, $xmlParent, $pgId)
	{
		$page = null;
		try {
			if( $pgId == null ) {
				$page = new Page( array() );
			} else {
				$page = new Page( array('pageId'=>$pgId) );
			}
		} catch( PropertyException $pe ) {
			echo "ERROR: ".$pe->getMessage();
		} catch( MySQLException $mse ) {
			echo "ERROR: ".$mse->getMessage();
		}
		
		$idAttr = $domDoc->createAttribute("id");
		$idValue = $domDoc->createTextNode($page->id);
		$idAttr->appendChild($idValue);
		
		$nameAttr = $domDoc->createAttribute("name");
		$nameValue = $domDoc->createTextNode($page->page_name);
		$nameAttr->appendChild($nameValue);
		
		$frontAttr = $domDoc->createAttribute("front");
		$frontValue = $domDoc->createTextNode($page->front_page_flag);
		$frontAttr->appendChild($frontValue);
		
		$frontOrderAttr = $domDoc->createAttribute("front_order");
		$frontOrderValue = $domDoc->createTextNode($page->front_page_order);
		$frontOrderAttr->appendChild($frontOrderValue);
		
		$xmlParent->appendChild($idAttr);
		$xmlParent->appendChild($nameAttr);
		$xmlParent->appendChild($frontAttr);
		$xmlParent->appendChild($frontOrderAttr);
		
		$banner = $domDoc->createElement("banner");
		$pageBanner = $domDoc->createTextNode($page->page_banner);
		$banner->appendChild($pageBanner);
		$xmlParent->appendChild($banner);
		
		$iconUp = $domDoc->createElement("icon_up");
		$pageIconUp = $domDoc->createTextNode($page->page_icon_up);
		$iconUp->appendChild($pageIconUp);
		$xmlParent->appendChild($iconUp);
		
		$iconOver = $domDoc->createElement("icon_over");
		$pageIconOver = $domDoc->createTextNode($page->page_icon_over);
		$iconOver->appendChild($pageIconOver);
		$xmlParent->appendChild($iconOver);
		
		$iconDown = $domDoc->createElement("icon_down");
		$pageIconDown = $domDoc->createTextNode($page->page_icon_down);
		$iconDown->appendChild($pageIconDown);
		$xmlParent->appendChild($iconDown);
		
		$content = $domDoc->createElement("content");
		$text = $domDoc->createTextNode($page->page_info);
		$content->appendChild($text);
		$xmlParent->appendChild($content);
	}
	
	static function generateNewsContent($domDoc, $xmlParent, $pgId)
	{
		$page = null;
		try {
			if( $pgId == null ) {
				$page = new Page( array() );
			} else {
				$page = new Page( array('pageId'=>$pgId) );
			}
		} catch( PropertyException $pe ) {
			echo "ERROR: ".$pe->getMessage();
		} catch( MySQLException $mse ) {
			echo "ERROR: ".$mse->getMessage();
		}
		
		$idAttr = $domDoc->createAttribute("id");
		$idValue = $domDoc->createTextNode($page->id);
		$idAttr->appendChild($idValue);
		
		$nameAttr = $domDoc->createAttribute("name");
		$nameValue = $domDoc->createTextNode($page->page_name);
		$nameAttr->appendChild($nameValue);
		
		$xmlParent->appendChild($idAttr);
		$xmlParent->appendChild($nameAttr);
		
		$banner = $domDoc->createElement("banner");
		$pageBanner = $domDoc->createTextNode($page->page_banner);
		$banner->appendChild($pageBanner);
		$xmlParent->appendChild($banner);
		
		
		$news = $domDoc->createElement("news");
		/*if( $news_items = News::getAllNews() ) {	
			foreach( $news_items as $item ) {
				$news_item = $domDoc->createElement("news_item");
				$news->appendChild($news_item);
				
				$idAttr = $domDoc->createAttribute("id");
				$idValue = $domDoc->createTextNode($item['id']);
				$idAttr->appendChild($idValue);
				
				$headline = $domDoc->createElement("headline");
				$headlineValue = $domDoc->createTextNode($item['headline']);
				$headline->appendChild($headlineValue);
				
				$short = $domDoc->createElement("short");
				$shortValue = $domDoc->createTextNode($item['short_text']);
				$short->appendChild($shortValue);
				
				$long = $domDoc->createElement("long");
				$longValue = $domDoc->createTextNode($item['long_text']);
				$long->appendChild($longValue);
				
				$date = $domDoc->createElement("date");
				$dateValue = $domDoc->createTextNode( date('M. n l Y', $item['creation_date']) );
				$date->appendChild($dateValue);
				
				$news_item->appendChild($idAttr);
				$news_item->appendChild($headline);
				$news_item->appendChild($short);
				$news_item->appendChild($long);
				$news_item->appendChild($date);
			}
		}*/
		$xmlParent->appendChild($news);
	}
	
	static function generateNoticesContent($domDoc, $xmlParent, $pgId)
	{
		$page = null;
		try {
			if( $pgId == null ) {
				$page = new Page( array() );
			} else {
				$page = new Page( array('pageId'=>$pgId) );
			}
		} catch( PropertyException $pe ) {
			echo "ERROR: ".$pe->getMessage();
		} catch( MySQLException $mse ) {
			echo "ERROR: ".$mse->getMessage();
		}
		
		$idAttr = $domDoc->createAttribute("id");
		$idValue = $domDoc->createTextNode($page->id);
		$idAttr->appendChild($idValue);
		
		$nameAttr = $domDoc->createAttribute("name");
		$nameValue = $domDoc->createTextNode($page->page_name);
		$nameAttr->appendChild($nameValue);
		
		$xmlParent->appendChild($idAttr);
		$xmlParent->appendChild($nameAttr);
		
		$banner = $domDoc->createElement("banner");
		$pageBanner = $domDoc->createTextNode($page->page_banner);
		$banner->appendChild($pageBanner);
		$xmlParent->appendChild($banner);
		
		$notices = $domDoc->createElement("notices");
		if( $notice_items = Notice::getAllNotices() ) {
			foreach( $notice_items as $item ) {
				$notice_item = $domDoc->createElement("notice_item");
				$notices->appendChild($notice_item);
				
				$idAttr = $domDoc->createAttribute("id");
				$idValue = $domDoc->createTextNode($item['id']);
				$idAttr->appendChild($idValue);
				
				$headline = $domDoc->createElement("headline");
				$headlineValue = $domDoc->createTextNode($item['headline']);
				$headline->appendChild($headlineValue);
				
				$long = $domDoc->createElement("long");
				$longValue = $domDoc->createTextNode($item['long_text']);
				$long->appendChild($longValue);
				
				$date = $domDoc->createElement("date");
				$dateValue = $domDoc->createTextNode( date('M. n l Y', $item['creation_date']) );
				$date->appendChild($dateValue);
				
				$notice_item->appendChild($idAttr);
				$notice_item->appendChild($headline);
				$notice_item->appendChild($long);
				$notice_item->appendChild($date);
			}
		}
		$xmlParent->appendChild($notices);
	}
	
	static function generateAboutContent($domDoc, $xmlParent)
	{
		include("statics.php");
	
		$blurb = $domDoc->createElement("blurb");
		$blurbValue = $domDoc->createTextNode($aboutBlurb);
		$blurb->appendChild($blurbValue);
		
		$xmlParent->appendChild($blurb);	
	}
	
	static function generateHomeContent($domDoc, $xmlParent)
	{
		include("statics.php");
	
		$columnLeft = $domDoc->createElement("column_left");
		$xmlParent->appendChild($columnLeft);
		
		$leftVideo = $domDoc->createElement("video");
		$leftVideoValue = $domDoc->createTextNode($videoOne);
		$leftVideo->appendChild($leftVideoValue);
		
		$leftDesc = $domDoc->createElement("desc");
		$leftDescValue = $domDoc->createTextNode($descOne);
		$leftDesc->appendChild($leftDescValue);
		
		$columnLeft->appendChild($leftVideo);
		$columnLeft->appendChild($leftDesc);
		
		$columnMiddle = $domDoc->createElement("column_middle");
		$xmlParent->appendChild($columnMiddle);
		
		$middleVideo = $domDoc->createElement("video");
		$middleVideoValue = $domDoc->createTextNode($videoTwo);
		$middleVideo->appendChild($middleVideoValue);
		
		$middleDesc = $domDoc->createElement("desc");
		$middleDescValue = $domDoc->createTextNode($descTwo);
		$middleDesc->appendChild($middleDescValue);
		
		$columnMiddle->appendChild($middleVideo);
		$columnMiddle->appendChild($middleDesc);
		
		$columnRight = $domDoc->createElement("column_right");
		$xmlParent->appendChild($columnRight);
		
		$rightVideo = $domDoc->createElement("video");
		$rightVideoValue = $domDoc->createTextNode($videoThree);
		$rightVideo->appendChild($rightVideoValue);
		
		$rightDesc = $domDoc->createElement("desc");
		$rightDescValue = $domDoc->createTextNode($descThree);
		$rightDesc->appendChild($rightDescValue);
		
		$columnRight->appendChild($rightVideo);
		$columnRight->appendChild($rightDesc);
	}
}
?>