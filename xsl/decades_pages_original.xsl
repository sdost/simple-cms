<xsl:transform version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
	<xsl:template match="/">
        <html>
            <head>
                <title>The Official Website of the Greatest Game in History</title>
            </head>
            <body>
                <link rel="stylesheet" type="text/css" href="/css/decades.css.php" />
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
                    </div>
                </div>
                <div id="footer">
                	<div id="top"><a href="#top">Page Top <img src="/content/image/pagetoptriangle_up.png" /></a></div>
                    <div id="crumb" class="breadcrumb">
                    	<xsl:apply-templates select="page_layout/breadcrumb"/>
                    </div>
                </div>
            </body>
        </html>
    </xsl:template>
    
    <xsl:template match="page_layout/breadcrumb">
    	<xsl:for-each select="crumb_item">
	        <a href="/test">Home</a> > <xsl:value-of select="@name"/>
        </xsl:for-each>                
    </xsl:template>
   
   	<xsl:template match="page_layout/menu_layout">
        <div class="menu_header"><img alt="header" src="/content/image/categoriesbox_title.png"/></div>
        <div class="menu_block">
            <xsl:for-each select="menu_item">
            <xsl:sort select="order"/>
            <div class="menu_item">
                <div><a id="id_{id}" href="/{link}"><img alt="{name}" src="/content/image/blank_button.png" /></a></div>
            </div>                 
            </xsl:for-each>
        </div>       
   	</xsl:template>
   
   	<xsl:template match="page_layout/content_layout">
    	<div class="content_header"><img alt="banner_{@name}" src="{banner}" style="width: 262px; height: 47px;" /></div>
        <div class="content_block">
        	<xsl:value-of select="content" disable-output-escaping="yes"/>
        </div>
    </xsl:template>
</xsl:transform>