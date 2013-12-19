<?php if(!class_exists('raintpl')){exit;}?>        <script src="views///ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="views/js/vendor/jquery-1.8.0.min.js"><\/script>')</script>
        <script src="views/js/vendor/jquery.validate.min.js"></script>
        <script src="views/js/vendor/bootstrap.min.js"></script>
        <script src="views/js/main.js"></script>
        <script>
            $(document).ready(function () {
         $('#myModal').modal({
             show: false,
             keyboard: false
         });
         $('#register_form').validate({
             rules: {
                 novadv: {
                     required: function () {
                         if ($("#novadv").val() == "") {
                             return true;

                         } else {
                             return false;
                         }
                     }
                 },
                 school: {
                     minlength: 5,
                     required: true
                 },
                 teamnumber: {
                     minlength: 1,
                     required: true,
                     number: true
                 },
                 password: {
                     minlength: 5,
                     required: true
                 },
                 passwordc: {
                     required: true,
                     minlength: 5,
                     equalTo: "#password"
                 },
                 member1: {
                     minlength: 4,
                     required: true
                 }
             },
             errorClass: "help-inline",
             errorElement: "span",
             highlight: function (element, errorClass, validClass) {
                 $(element).parents('.control-group').addClass('error');
             },
             unhighlight: function (element, errorClass, validClass) {
                 $(element).parents('.control-group').removeClass('error');
                 $(element).parents('.control-group').addClass('success');
             },
             submitHandler: function (form) {
                 var novadv = $("#novadv option:selected").val();
                 var school = $("#school").val();
                 var teamnumber = $("#teamnumber").val();
                 var password = $("#password").val();
                 var passwordc = $("#passwordc").val();
                 var member1 = $("#member1").val();
                 var member2 = $("#member2").val();
                 var member3 = $("#member3").val();
                 var dataString = 'novadv=' + novadv + '&school=' + school + '&teamnumber=' + teamnumber + '&password=' + password + '&member1=' + member1 + '&member2=' + member2 + '&member3=' + member3;
                 $("#register").addClass("disabled");
                 $("#register").addClass("btn-success").removeClass("btn-inverse"); 
                 $('#register').attr('value', 'Submitting...');
                 $.ajax({
                     type: "POST",
                     url: "ajaxinsert.php",
                     data: dataString,
                     cache: false,
                     success: function (html) {

                     }
                 });
             }
         });
        });
        </script>
    </body>
</html>