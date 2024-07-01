const Toast = Swal.mixin({
  toast: true,
  position: 'top',
  iconColor: '#f8bb86',
  customClass: {
    popup: 'colored-toast',
  },
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true,
});
