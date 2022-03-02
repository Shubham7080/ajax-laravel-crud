$(document).ready(function(){
    showdata();
});

$("#Form").on("submit", function (e) {
    e.preventDefault();
    $.ajax({
        url: "user",
        type: "POST",
        data: new FormData(this),
        contentType:false,
        processData:false,
        success: function (resp) {
            if(resp.code==200 && resp.status==true){
                alert(resp.message);
                $("#Form").trigger("reset");
                $('#post_id').val('');
                $("#button").val("Submit");
            }else if(resp.code==201 && resp.status==false){
                alert(resp.message);
            }else if(resp.code==301 && resp.status==false){
                alert(resp.message);
            }
            $('#tbl_data').DataTable().destroy();
            showdata();
        }
    })
})

// js ajax function for show data 
function showdata(){
    $('#tbl_data').DataTable({
        processing: true,
        serverSide: true,
        'ordering':true,
        'order':[[0,"desc"]],
        ajax: siteURL+"/showdata",
        "method": "GET",
        columns: [
        {data: 'id', name: 'id'},
        {data: 'title', name: 'title'},
        {data: 'description', name: 'description'},
        {
            data: 'action', 
            name: 'action', 
            orderable: true, 
            searchable: true
        },
        {
            data: 'action1', 
            name: 'action1', 
            orderable: true, 
            searchable: true
        },
    ]          
    });
}
function delete_data(id)
{
    if(confirm("are you sure to delete data")){
        $.ajaxSetup({
            headers:{'X-CSRF-Token' : $('meta[name=_token]').attr('content')}
        })
        $.ajax({
            url:"delete_data",
            type:"post",
            data:{id:id},
            success:function(response){
                if(response.status==true && response.code==200){
                    alert(response.message);
                    
                }
                else{
                    alert(response.message);
                }
                $('#tbl_data').DataTable().destroy();
                showdata();
            }
        })
    }
    
}// end of function

function editdata(id){
    $.ajax({
        url:"edit_data",
        type:"get",
        data:{id:id},
        success:function(response){
            if(response.status==true && response.code==200 && response.data.length!=0){
                $("#title").val(response.data.title);
                $("#desc").val(response.data.description);
                $("#post_id").val(response.data.id);
                $("#button").val("Update");
                
            }
            else{
                alert(response.message);
            }
        }
    })
}// End of Function





