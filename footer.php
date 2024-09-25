<footer class="footer aa mt-5">
  <!-- Widgets - Bootstrap Brain Component -->
  <section class="py-4 py-md-5 py-xl-8">
    <div class="container-fluid overflow-hidden">
      <div class="row gy-4 gy-lg-0 justify-content-xl-between text-dark">
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <div class="widget">
            <a href="index.php">
              <img src="images/ss.png" alt="Blog Logo" title="Posts" style="width: 50px; height: auto;">
            </a>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <div class="widget">
            <h4 class="widget-title mb-4">Get in Touch</h4>
            <address class="mb-4">Indore, Madhya Pradesh, India.</address>
            <p class="mb-1">
              <a href="tel:100">(+91) 100</a>
            </p>
            <p class="mb-0">
              <a href="https://github.com/devendra-singh-goud">GitHub</a>
            </p>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <div class="widget">
            <h4 class="widget-title mb-4">Learn More</h4>
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="#!">About</a>
              </li>
              <li class="mb-2">
                <a href="#!">Contact</a>
              </li>
              <li class="mb-2">
                <a href="#!">Advertise</a>
              </li>
              <li class="mb-2">
                <a href="#!">Terms of Service</a>
              </li>
              <li class="mb-0">
                <a href="#!">Privacy Policy</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-lg-3 col-xl-4">
          <div class="widget">
            <h4 class="widget-title mb-4">Actions</h4>
            <ul class="nav flex-column">
              <?php if (isset($_SESSION['username'])): ?>
                <li class="nav-item">
                  <a class="nav-link" href="create.php">Add New Post</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="logout.php">Logout</a>
                </li>
                <li class="nav-item">
                  <span class="text-muted">Logged in as: <strong class="text-dark font-italic"><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                </li>
              <?php else: ?>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
</footer>
