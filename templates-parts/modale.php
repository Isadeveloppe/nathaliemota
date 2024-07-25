<div class="modal" id="menu-modal">
    <div class="modal_content" id="modal-content">
    <button id="burger-button" class="modal_burger">
        <span class="line"></span>
        <span class="line"></span>
        <span class="line"></span>
      </button>
        <?php wp_nav_menu(array(
        'theme_location' => 'header',
        'container'      => 'menu-header-container',
        'menu_class'     => 'links',
    )); ?>
  </div>
</div>

