<script>
  function formReset(){
    const addProjectForm = document.querySelectorAll('.add-project');
    addProjectForm.forEach(form => {
      form.value = '';
      location.reload();
    });
  }
</script>
