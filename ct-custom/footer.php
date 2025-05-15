<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer">
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
<script>
document.addEventListener("DOMContentLoaded", function () {
  const hamburgerMenu = document.getElementById("hamburgerMenu");
  const menu = document.querySelector(".menu"); // Use the correct selector for the menu

  // Toggle the menu visibility when the hamburger menu is clicked
  hamburgerMenu.addEventListener("click", function () {
    menu.classList.toggle("show");
  });
});

</script>
</body>
</html>
