<script type="text/javascript">
	$(document).ready(function(){
		var options = {
			valueNames: ['name'],
			page:10,
			pagination:true,
		};
		var nameList = new List('name-list', options);		
		$('.basic-datatables').DataTable({
		});
	})
	function add(){
		var url=$("#add").attr('url');   
		$("#view").load(url);      
	}
	function hapus(id){
		var url=$('.hapus').attr('url');
		swal({
			title: 'Anda yakin?',
			text: "Data akan dihapus permanen",
			type: 'warning',
			buttons:{
				confirm: {
					text : 'Iya, hapus saja!',
					className : 'btn btn-success'
				},
				cancel: {
					visible: true,
					className: 'btn btn-danger'
				}
			}
		}).then((Delete) => {
			if (Delete) {
				window.location.href=url+id
			} else {
				swal.close();
			}
		});		
		return false    		
	}	
  function detail(id){   
    var url=$('.detail').attr('url');
    $.ajax({
      type:'POST',
      url:url,
      data:{id:id},
      success:function(data){
        $("#view").html(data);       
      }
    })
    return false;
    // alert(url);


  }  	
</script>