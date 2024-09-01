<!-- Footer 2 - Bootstrap Brain Component -->
<footer class="footer">

  <!-- Widgets - Bootstrap Brain Component -->
  <section class="bg-light py-4 py-md-5 py-xl-8 border-top border-light">
    <div class="container overflow-hidden">
      <div class="row gy-4 gy-lg-0 justify-content-xl-between">
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
            <address class="mb-4">Indore, Madhya pradesh, India.</address>
            <p class="mb-1">
              <a class="link-secondary text-decoration-none" href="tel:+15057922430">(+91) 792-2430</a>
            </p>
            <p class="mb-0">
              <a class="link-secondary text-decoration-none" href="mailto:demo@yourdomain.com">demo@yourdomain.com</a>
            </p>
          </div>
        </div>
        <div class="col-12 col-md-4 col-lg-3 col-xl-2">
          <div class="widget">
            <h4 class="widget-title mb-4">Learn More</h4>
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="#!" class="link-secondary text-decoration-none">About</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="link-secondary text-decoration-none">Contact</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="link-secondary text-decoration-none">Advertise</a>
              </li>
              <li class="mb-2">
                <a href="#!" class="link-secondary text-decoration-none">Terms of Service</a>
              </li>
              <li class="mb-0">
                <a href="#!" class="link-secondary text-decoration-none">Privacy Policy</a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-12 col-lg-3 col-xl-4">
          <div class="widget">
            <h4 class="widget-title mb-4">Actions</h4>
            <ul class="list-unstyled">
              <li class="mb-2">
                <a href="index.php" class="link-secondary text-decoration-none">Home</a>
               
              </li>
              <li class="mb-2">
               <a href="create.php" class="link-secondary text-decoration-none">Add New Post</a>
              </li>
              <li class="mb-0">
                <?php if (isset($_SESSION['username'])): ?>
                  <a href="logout.php" class="link-secondary text-decoration-none">Logout</a>
                <?php else: ?>
                  <a href="login.php" class="link-secondary text-decoration-none">Login</a>
                <?php endif; ?>
              </li>
              <li class="mt-2">
                <?php if (isset($_SESSION['username'])): ?>
                  <span>Logged in as: <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong></span>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Copyright - Bootstrap Brain Component -->
  <div class="bg-light py-4 py-md-5 py-xl-8 border-top border-light-subtle">
    <div class="container overflow-hidden">
      <div class="row gy-4 gy-md-0 align-items-md-center">
        <div class="col-xs-12 col-md-7 order-1 order-md-0">
          <div class="copyright text-center text-md-start">
            &copy; 2024. All Rights Reserved.
          </div>
          <div class="credits text-secondary text-center text-md-start mt-2 fs-8">
            Built by <a href="https://bootstrapbrain.com/" class="link-secondary text-decoration-none">Devendra_singh_goud</a> with <span class="text-danger">&#9829;</span>
          </div>
        </div>

        <div class="col-xs-12 col-md-5 order-0 order-md-1">
          <div class="social-media-wrapper">
            <ul class="list-unstyled m-0 p-0 d-flex justify-content-center justify-content-md-end">
              <li class="me-3">
                <a href="#!" class="link-dark link-opacity-75-hover">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                    <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                  </svg>
                </a>
              </li>
              <li class="me-3">
                <a href="#!" class="link-dark link-opacity-75-hover">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-youtube" viewBox="0 0 16 16">
                    <path d="M8.051 1.999h.089c.822.003 4.987.033 6.11.335a2.01 2.01 0 0 1 1.415 1.42c.101.38.172.883.22 1.402l.01.104.022.26.008.104c.065.914.073 1.77.074 1.957v.075c-.001.194-.01 1.108-.082 2.06l-.008.105-.009.104c-.05.572-.124 1.14-.235 1.558a2.007 2.007 0 0 1-1.415 1.42c-1.16.312-5.569.334-6.18.335h-.142c-.309 0-1.587-.006-2.927-.052l-.17-.006-.087-.004-.171-.007-.171-.007c-1.11-.049-2.167-.128-2.654-.26a2.007 2.007 0 0 1-1.415-1.419c-.111-.417-.185-.986-.235-1.558L.09 9.82l-.008-.104A31.4 31.4 0 0 1 0 7.68v-.123c.002-.215.01-.958.064-1.778l.007-.103.003-.052.008-.104.022-.26.01-.104c.048-.519.119-1.023.22-1.402a2.007 2.007 0 0 1 1.415-1.42c.487-.13 1.544-.21 2.654-.26l.17-.007.172-.006.086-.003.171-.007A99.788 99.788 0 0 1 7.858 2h.193zM6.4 5.209v4.818l4.157-2.408L6.4 5.209z" />
                  </svg>
                </a>
              </li>
              <li class="me-3">
                <a href="#!" class="link-dark link-opacity-75-hover">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-twitter" viewBox="0 0 16 16">
                    <path d="M5.026 15c6.038 0 9.341-5.003 9.341-
                    