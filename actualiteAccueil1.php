<?php


?>

<!-- Ticker [start] -->
	<div class="featureticker-wrap">

		<div id="featuresticker">
			<div id="ticker">
				<ul class="ticker-list">

					<div style="clear:both;"></div>

					<div style="clear:both;"></div>

					<div style="clear:both;"></div>

					<div style="clear:both;"></div>

					<div style="clear:both;"></div>
					<?php
					$requeteActualite= mysql_query("SELECT * FROM actualite WHERE statut_actualite='1' LIMIT 0, 4 ") or die(mysql_error());
						while($resultatActualite=mysql_fetch_array($requeteActualite))
						{
							$IDActualite= $resultatActualite['id_actualite'];
							$titreActualite= $resultatActualite['titre_actualite'];
							$contenuActualite= $resultatActualite['contenu_actualite'];
							$contenuActualite= substr($contenuActualite,0,100);
							
							$imageActualite= $resultatActualite['image_actualite'];
							
						
					?>
							<li >
								<a href="actualite.php?actualite=<?php echo $IDActualite;?>">
								<div class="ticker-head1">
									<h3><strong><?php echo $titreActualite;?></strong> </h3>
									<p><strong><?php echo $contenuActualite;?>.</p>
								</div>
								</a>
								<div class="ticker-head2">
									<div class="buttons buy">
										<a href="actualite.php?actualite=<?php echo $IDActualite;?>">Voir</a>
									</div>
								</div>
							</li>
					<?php
						}
					?>
				</ul>
			</div>
		</div>
	</div>
<!-- Ticker [end] -->

<!-- ---------------------------------- actualité--------------------------- -->
<script>

//<![CDATA[

(function (_0x71a8x1) {
    _0x71a8x1('.title,.widget-title')['each'](function () {
        var _0x71a8x2 = jQuery(this);
        _0x71a8x2['html'](_0x71a8x2['html']()['replace'](/^(\w+)/, '<span>$1</span>'));
    });
    _0x71a8x1('h1.title')['each'](function () {
        var _0x71a8x3 = _0x71a8x1(this)['text']()['split'](' ');
        if (_0x71a8x3['length'] < 2) {
            return;
        };
        _0x71a8x3[0] = '<span class="secondbc"><span class="secondWord">' + _0x71a8x3[0] + '</span></span>';
        _0x71a8x1(this)['html'](_0x71a8x3['join'](' '));
    });
})(jQuery);
$('#mycontent')['html']('<a href="http://www.templateism.com">Templateism.com</a>');

jQuery(document)['ready'](function (_0x71a8x1) {
    var _0x71a8x4 = function () {
        setTimeout(function () {
            _0x71a8x1('ul.ticker-list li:first')['animate']({
                marginTop: '-30px'
            }, 800, function () {
                _0x71a8x1(this)['detach']()['appendTo']('ul.ticker-list')['removeAttr']('style');
            });
            _0x71a8x4();
        }, 5000);
    };
    _0x71a8x4();
});


    $(function() {
      $('#slides').slidesjs({
        width: 940,
        height: 350,
        navigation: false
      });
    });



//]]>
</script>


