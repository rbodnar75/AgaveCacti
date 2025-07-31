<?php
/*
 +-------------------------------------------------------------------------+
 | Copyright (C) 2004-2024 The Cacti Group                                 |
 +-------------------------------------------------------------------------+
 | AgaveCacti Modern Theme - Bottom Footer                                 |
 +-------------------------------------------------------------------------+
*/

if (!isset_request_var('headercontent')) {?>
			</div> <!-- /agave-content -->
		</main> <!-- /agave-main -->
	</div> <!-- /agave-layout -->
	
	<?php api_plugin_hook('page_bottom'); ?>
</body>
</html>
<?php } else { ?>
			</div> <!-- /agave-content -->
<?php } ?>
