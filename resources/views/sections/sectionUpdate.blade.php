<form action="" method="post" autocomplete="off" id="SectionData">
    {{ csrf_field() }}
    {{method_field('PUT')}}
    <div class="form-group">
        <input class="form-control" name="section_id" type="hidden"
               value="@if (isset($SectionEdit)){{$SectionEdit->id}}@else{{''}}@endif">
        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
        <input class="form-control" name="section_name" id="section_name" type="text"
               value="@if (isset($SectionEdit)){{$SectionEdit->section_name}}@else{{''}}@endif">
        <small id="section_name_error" class="form-text text-danger"></small>
    </div>
    <div class="form-group">
        <label for="message-text" class="col-form-label">ملاحظات:</label>
        <textarea class="form-control" id="description" name="description">@if (isset($SectionEdit)){{$SectionEdit->description}}@else{{''}}@endif</textarea>
        <small id="description_error" class="form-text text-danger"></small>
    </div>
    <div class="modal-footer">
        <button id="UpdateSection" data-resource="sections" class="btn btn-primary">تاكيد</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
    </div>
</form>

<script>
    // function update(id){
    //     $.ajax({
    //         url: "sections/update/"+id,
    //         datatype : "html",
    //         success: function (result) {
    //             alert(true);
    //         }
    //     });
    // }
    $(document).ready(function () {
        if($('#section_name').val() !== ''){
            $('#section_name').prop('readonly',true);
        }
        $('#UpdateSection').on('click',function (e){
            e.preventDefault();
            $('#section_name_error').text('');
            $('#description_error').text('');
            var resource = $(this).data("resource");
            let myForm = document.getElementById('SectionData');
            let formData = new FormData(myForm);
            let id = formData.getAll('section_id');
            $.ajax({
                type:'post',
                url: resource+"/"+id,
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success:function (data){
                    if(data.status === true){
                        $('#modaldemo8').removeClass('effect-scale show').css("display","none");
                        $('.modal-backdrop').removeClass('modal-backdrop show');
                        Swal.fire({
                            icon: 'success',
                            title: data.msg,
                            showConfirmButton: true,
                            timer: 2500
                        })
                        setTimeout(function () {
                            location.reload(true);
                        }, 2500);
                    }

                },
                error:function (reject){
                    var response = $.parseJSON(reject.responseText);
                    $.each(response.errors, function (key,val){
                        $("#"+key+"_error").text(val[0]);
                    });
                }

            });
        });
    })
</script>
