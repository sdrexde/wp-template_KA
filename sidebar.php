<aside id="sidebar">
  <?php if ( is_active_sidebar( 'primary-sidebar' ) ) : ?>
    <?php dynamic_sidebar( 'primary-sidebar' ); ?>
  <?php else : ?>
    <div class="widget">
      <h2>Sidebar</h2>
      <p>Füge Widgets im WordPress-Backend hinzu.</p>
    </div>
  <?php endif; ?>
</aside>
