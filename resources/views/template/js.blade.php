    <script src="{{url('assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{url('assets/vendors/chart.js')}}"></script>
    <script src="{{url('assets/vendors/progressbar.js')}}"></script>
    <script src="{{url('assets/vendors/jvectormap/jquery-jvectormap.min.js')}}"></script>
    <script src="{{url('assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <script src="{{url('assets/vendors/owl-carousel-2/owl.carousel.min.js')}}"></script>
    <script src="{{url('assets/vendors/sweetalert2/sweetalert2.min.js')}}"></script>
    <!-- End plugin js for this page -->
    <script src="{{url('assets/vendors/select2/select2.min.js')}}"></script>
    <!-- inject:js -->
    <script src="{{url('assets/js/off-canvas.js')}}"></script>
    <script src="{{url('assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{url('assets/js/misc.js')}}"></script>
    <script src="{{url('assets/js/settings.js')}}"></script>
    <script src="{{url('assets/js/todolist.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="{{url('assets/js/dashboard.js')}}"></script>

    <script src="{{url('assets/js/file-upload.js')}}"></script>
    <script src="{{url('assets/js/typeahead.js')}}"></script>
    <script src="{{url('assets/js/select2.js')}}"></script>

    <script src="{{url('assets/vendors/lightbox/fslightbox.js')}}"></script>

    <script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>

    <script>
        $(function() { 
            $(".nav-item.menu-items.active").removeClass("active"); 
        });
    </script>

<script>
    function hapus(url){
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't delete this data",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#696cff',
            cancelButtonColor: '#ff3e1d',
            confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
            if (result.isConfirmed) {
                location.href=url; 
                Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
                )
            }
            })
        }
</script>