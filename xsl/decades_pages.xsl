<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
        <html>
            <head>
                <title>The Official Website of the Greatest Game in History</title>
                <script type="text/javascript" language="javascript" src="js/prototype.js"></script>
                <script type="text/javascript" language="javascript" src="js/scriptaculous.js"></script>
                <script type="text/javascript" language="javascript" src="js/flashembed.min.js"></script>
            </head>
            <body>
                <div class="imageLoader"/>
                <link rel="stylesheet" type="text/css" href="css/decades.css.php" />
                <div id="header" />
                <div id="main_body">
                    <div class="menu">
                        <xsl:apply-templates select="page_layout/menu_layout"/>
                    </div>
                    <div class="content">
                        <div class="breadcrumb">
                            <xsl:apply-templates select="page_layout/breadcrumb"/>
                        </div>
                        <xsl:apply-templates select="page_layout/content_layout"/> 
                    	<xsl:apply-templates select="page_layout/home_layout"/>
                    </div>
                </div>
                <div id="footer" >
                	<div id="top"><a href="#top">Page Top <img src="content/image/pagetoptriangle_up.png" /></a></div>
                    <div id="crumb" class="breadcrumb">
                    	<xsl:apply-templates select="page_layout/breadcrumb"/>
                    </div>
                    <div id="blog" align="center"><a href="http://smercdesign.blogspot.com">SMERC Blog</a></div>
                    <div id="twitter" align="center"><a href="http://twitter.com/SMERC_Design">SMERC Twitter</a></div>
                </div>
				<script type="text/javascript">
					var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
					document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
				</script>
				<script type="text/javascript">
					try {
						var pageTracker = _gat._getTracker("UA-10628966-1");
						pageTracker._trackPageview();
					} 
					catch(err) {alert("analytics failed");}
				</script>
            </body>
        </html>
    </xsl:template>
    
    <xsl:template match="page_layout/breadcrumb">
    	<xsl:for-each select="crumb_item">
	        <a href="http://www.decadesthegame.com">Home</a> > <xsl:value-of select="@name"/>
        </xsl:for-each>                
    </xsl:template>
   
   	<xsl:template match="page_layout/menu_layout">
        <div class="menu_header"><img alt="header" src="content/image/categoriesbox_title.png"/></div>
        <div class="menu_block">
            <xsl:for-each select="menu_item">
            <xsl:sort select="order" data-type="number"/>
            <div class="menu_item">
                <div><a id="id_{id}" href="{link}"><img alt="{name}" src="content/image/blank_button.png" /></a></div>
            </div>                 
            </xsl:for-each>
        </div>
        <xsl:apply-templates select="about"/>      
   	</xsl:template>
   
   	<xsl:template match="page_layout/content_layout">
    	<div class="content_header"><img alt="banner_{@name}" src="{banner}" style="width: 262px; height: 47px;" /></div>
        <div class="content_block">
        	<xsl:apply-templates select="content"/>
			<xsl:apply-templates select="news"/>
			<xsl:apply-templates select="notices"/>
        </div>
    </xsl:template>
    
    <xsl:template match="page_layout/home_layout">
    <div id="columns">	
       <table>
        	<tr>
            	<td id="column_left">
                	<div class="video" id="flowplayerholder1"></div>
                    <div class="desc"><xsl:value-of select="column_left/desc"/></div>
                    <script type="text/javascript" language="javascript">
					new flashembed("flowplayerholder1", { src: 'swf/FlowPlayerDark.swf', width: 222, height: 164 }, { config: { videoFile: '<xsl:value-of select="column_left/video"/>', showVolumeSlider: false, controlsOverVideo: 'ease', controlBarBackgroundColor: -1, controlBarGloss: 'low' } });
					</script>
                </td>
                <td></td><em></em>
                <td id="column_middle">
					<div class="video" id="flowplayerholder2"></div>
                    <div class="desc"><xsl:value-of select="column_middle/desc"/></div>
                    <script type="text/javascript" language="javascript">
					new flashembed("flowplayerholder2", { src: 'swf/FlowPlayerDark.swf', width: 222, height: 164 }, { config: { videoFile: '<xsl:value-of select="column_middle/video"/>', showVolumeSlider: false, controlsOverVideo: 'ease', controlBarBackgroundColor: -1, controlBarGloss: 'low' } });
					</script>                
                </td>
                <td></td>
                <td id="column_right">	
                	<div class="video" id="flowplayerholder3"></div>
                    <div class="desc"><xsl:value-of select="column_right/desc"/></div>
                    <script type="text/javascript" language="javascript">
					new flashembed("flowplayerholder3", { src: 'swf/FlowPlayerDark.swf', width: 222, height: 164 }, { config: { videoFile: '<xsl:value-of select="column_right/video"/>', showVolumeSlider: false, controlsOverVideo: 'ease', controlBarBackgroundColor: -1, controlBarGloss: 'low' } });
					</script>                
                </td>
            </tr>
        </table>
    </div>
    </xsl:template>
    
    <xsl:template match="about">
    	<div class="about_header"><img alt="header" src="content/image/aboutdecades_titles.png"/></div>
        <div class="about_block">
            <xsl:value-of select="blurb"/>                 
        </div>
    </xsl:template>
    
    <xsl:template match="content">
    	<xsl:value-of select="text()" disable-output-escaping="yes"/>
    </xsl:template>
    
    <xsl:template match="news">
    <div id="news_container">
    	<ul id="news_list">
    	<xsl:for-each select="news_item">
        	<li>
            <table><tr>
                <td class="news_icon">
                	<img src="content/image/news_box.jpg" alt=""/>
                </td>
                <td class="news_entry">
                    <div class="entry_date"><xsl:value-of select="date"/></div>
                    <div class="headline"><xsl:value-of select="headline"/></div>
                    <div id="short_{@id}" class="short_news"><div><xsl:value-of select="short"/></div></div>
                </td>
                <td class="full_button">
                	<a href="#" onclick="Effect.toggle('news_{@id}','slide'); Effect.toggle('short_{@id}', 'appear'); return false;">
                    <img src="content/image/arrow_icon.png" alt=""/>Full Story
                    </a>
                </td>
            </tr></table>
           	<div id="news_{@id}" class="news_text" style="display: none;">
            	<div><xsl:value-of select="long"/></div>
            </div>
            </li>
        </xsl:for-each>
        </ul>
    </div>
    </xsl:template>
    
    <xsl:template match="notices">
    <div id="notices_container">
    	<ul id="notices_list">
    	<xsl:for-each select="notice_item">
        	<li>
            <table><tr>
                <td class="left_bar"></td>
                <td class="notice_entry">
                    <a href="#" onclick="Effect.toggle('notice_{@id}','slide'); return false;">
                    <img src="content/image/arrow_icon.png" alt=""/><xsl:value-of select="headline"/>
                    </a>
                </td>
                <td class="separator"></td>
                <td class="entry_date"><xsl:value-of select="date"/></td>
            </tr></table>
           	<div id="notice_{@id}" class="notice_text" style="display: none;">
            	<div><xsl:value-of select="long"/></div>
            </div>
            </li>
        </xsl:for-each>
        </ul>
    </div>
    </xsl:template>
</xsl:transform>