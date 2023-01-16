<script>
  //Ocultar modal depois de clicar em actualizar
   window.addEventListener('close-modal',event=>{
     $('#editImovel').modal('hide')
   })
  
   window.addEventListener('close-modal',event=>{
     $('#editCliente').modal('hide')
   })
 

  //Mensagem de sucesso
  window.addEventListener('success',event=>{
    const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 1500
            });
            
            Toast.fire({
              icon: 'success',
              title: event.detail.message
            })
  })
  //Mensagem de erro
  window.addEventListener('error',event=>{
    const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 1500
            });
            
            Toast.fire({
              icon: 'error',
              title: event.detail.message
            })
  })
  //Mensagem de erro do servidor
  window.addEventListener('error',event=>{
    const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 1500
            });
            
            Toast.fire({
              icon: 'error',
              title: event.detail.message
            })
  })
 
</script>