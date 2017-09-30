
$("document").ready(function () {
    $("#signup").submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'reg',
            type: 'POST',
            data: $(this).serialize(),
            success: function (response) {
                if (response === '') {
                    window.location = '/';
                } else {
                    $('.checkLogin').html(response);
                }
            }
        })
    });
    
    $('#signin').submit(function (e) {
        e.preventDefault();

       $.ajax({
           url: '',
           type: 'POST',
           data: $(this).serialize(),
           success: function (responce) {
               if (responce === '') {
                   window.location = 'adminPanel';
               } else {
                   $('.authError').html(responce);
               }
           }
       })
    });

    $("#createUser").submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'createUser',
            type: 'POST',
            data: $(this).serialize(),
            success: function (responce) {
                if (responce === '') {
                    window.location = 'adminPanel';
                } else {
                    $('.checkLogin').html(responce);
                }
            }
        })
    });
    
    $('#inputEmail3').change(function () {
        $.ajax({
            url: 'checkLogin',
            type: 'POST',
            data: {
                'login' : $(this).val()
            },
            success: function (response) {
                console.log(response);
                if (response === '') {
                    $('#reg').removeAttr('disabled');
                    $('.checkLogin').html('');
                } else {
                    $('#reg').attr('disabled', 'disabled');
                    $('.checkLogin').html(response);
                }
            }
        })
    });

    $('#addFile').click(function (e) {
        var fd = new FormData();
        fd.append('file', $('#file').prop('files')[0]);

       $.ajax({
           url: 'addFile',
           type: 'POST',
           processData: false,
           contentType: false,
           data: fd,
           success : function (responce) {

           }
       })
    });

    $('#setAvatar').click(function (e) {
        var fd = new FormData();
        fd.append('avatar', $('#avatar').prop('files')[0]);
        fd.append('userId', $('#chooseUser').val());

        $.ajax({
            url: 'setAvatar',
            type: 'POST',
            processData: false,
            contentType: false,
            data: fd,
            success : function (responce) {
                window.location = 'adminPanel';
            }
        })
    });

    $('#editMyProfile').submit(function (e) {
        e.preventDefault();

        $.ajax({
            url: 'editMyProfile',
            type: 'POST',
            data: $(this).serialize(),
            success : function (responce) {
                window.location = 'adminPanel';
            }
        })
    })
});


