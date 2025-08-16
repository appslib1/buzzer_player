<?php
/**
 * Template Name: Home Page
 * Description: A custom page template with a special layout.
 */

get_header(); // Include header
?>

<!-- Bloc Hero -->
<div class="hero-section">
  <div class="hero-content">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Fichier 8.png" alt="Decoration" class="decoration decoration-top-left">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Fichier 13.png" alt="Decoration" class="decoration decoration-top-right">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Fichier 39.png" alt="Decoration" class="decoration decoration-bottom-left">
    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Fichier 40.png" alt="Decoration" class="decoration decoration-bottom-right">
    <h1 class="hero-title">CUSTOM YOUR BUZZER</h1>
    <p class="hero-description">Personalise the sound of your press button for a magic, funny and memorable moment!</p>
    <a href="#" class="button">ADD A SONG</a>
  </div>
</div>

<?php
get_footer(); // Include footer
