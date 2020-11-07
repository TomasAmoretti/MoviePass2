    
    <!-- Footer -->
    <footer class="sticky-footer bg-black">
      <div class="container my-auto">
        <div class="copyright text-center my-auto">
          <span>Copyright &copy; UTN - 2020</span>
        </div>
      </div>
    </footer>
    <!-- End of Footer -->

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="<?php echo FRONT_ROOT."User/Logout"?>">Logout</a>
          </div>
        </div>
      </div>
    </div>

      <!-- Bootstrap core JavaScript-->
    <script src="<?php echo VENDOR_PATH ;?>jquery/jquery.min.js"></script>
    <script src="<?php echo VENDOR_PATH ;?>bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
     <script src="<?php echo VENDOR_PATH ;?>jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo JS_PATH ;?>home.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?php echo VENDOR_PATH ;?>/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo VENDOR_PATH ;?>/datatables/dataTables.bootstrap4.min.js"></script>

    <script src="<?php echo VENDOR_PATH ;?>parallax.js/parallax.min.js"></script>
    <!-- Waypoints -->
    <script src="<?php echo VENDOR_PATH ;?>/waypoints/jquery.waypoints.min.js"></script>
    <!-- Slick carousel -->
    <script src="<?php echo VENDOR_PATH ;?>/slick/slick.min.js"></script>
    <!-- Magnific Popup -->
    <script src="<?php echo VENDOR_PATH ;?>/magnific-popup/jquery.magnific-popup.min.js"></script>
    <!-- Inits product scripts -->
    <script src="<?php echo JS_PATH ;?>/theme.js"></script>

    
    <!-- Page level custom scripts -->
    <script src="<?php echo JS_PATH ;?>/demo/datatables-demo.js"></script>
    <script src="<?php echo JS_PATH ;?>demo/chart-area-demo.js"></script>
    
    <script type="text/javascript">
      if(window.init){
        window.init($);
      }
    </script>
    <script async defer src="https://ia.media-imdb.com/images/G/01/imdb/plugins/rating/js/rating.js"></script>


  </body>

</html>