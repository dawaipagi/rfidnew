        <script type="text/javascript">
			var base_url='<?php echo base_url();?>';
        </script>
        <?php echo add_js($js); ?>
		<script type="text/javascript">
            $(function() {
                $(".content").slideDown();
                $(".error_lock_screen").fadeIn();
            });
        </script>
    </body>
</html>
