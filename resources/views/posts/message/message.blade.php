
<script>
const notyf = new Notyf({
  duration: 3000,
  position: { x: 'right', y: 'top' }
});

notyf.info = function (message) {
    this.open({
        type: 'info',
        background: '#dd0a0aff', 
        message: message
    });
};
notyf.warning = function (message) {
    this.open({
        type: 'info',
        background: '#79a31cff', 
        message: message
    });
};
notyf.Success = function (message) {
    this.open({
        type: 'info',
        background: '#0bc342ff', 
        message: message
    });
};

</script>