<form action="" method="post" autocomplete="off" id="SectionData">
    {{ csrf_field() }}
    <div class="form-group">

        <label for="recipient-name" class="col-form-label">اسم القسم:</label>
        <input class="form-control" name="section_name" id="section_name" type="text"
               value="">
        <small id="section_name_error" class="form-text text-danger"></small>
    </div>
    <div class="form-group">
        <label for="message-text" class="col-form-label">ملاحظات:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        <small id="description_error" class="form-text text-danger"></small>
    </div>
    <div class="modal-footer">
        <button id="SaveSection" class="btn btn-primary">تاكيد</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
    </div>
</form>

<script>

    $(document).ready(function () {
        // if($('#section_name').val() !== ''){
        //     $('#section_name').prop('readonly',true);
        // }
        $('#SaveSection').on('click',function (e){
            e.preventDefault();
            $('#section_name_error').text('');
            $('#description_error').text('');
            let myForm = document.getElementById('SectionData');
            let formData = new FormData(myForm);
            $.ajax({
                type:'post',
                url: '{{ route('sections.store') }}',
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
