<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script>
    document.querySelectorAll('.sidebar-menu li > label, .sidebar-menu li > a').forEach(item => {
        item.addEventListener('click', function() {
            const parentLi = this.parentElement;

            // Close all submenus
            document.querySelectorAll('.sidebar-menu li.has-submenu').forEach(li => {
                if (li !== parentLi) {
                    li.querySelector('input[type="checkbox"]').checked = false;
                }
            });

            // Toggle the active class for the clicked item
            parentLi.classList.toggle('active');
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@stack('script')
