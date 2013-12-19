 $(document).ready(function () {
    $(".preloader").fadeOut(1000);
    $('#myModal').modal({
        show: false,
        keyboard: false
    });
    $('#view_response').on('hidden', function() {
        $(this).removeData('modal');
    });
     $(function () {
        $.get("get_appeals.php?team="+$("#team_number").text()+"", function (data) {
            $("#appeals").append(data);
        });
    });
    $('#form').validate({
        rules: {
            teamnumberd: {
                minlength: 1,
                required: true,
                number: true
            },
            passwordd: {
                minlength: 5,
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('success');
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        },
        submitHandler: function (form) {
            var teamnumber = $("#teamnumberd").val();
            var password = $("#passwordd").val();
            var dataString = '&teamnumber=' + teamnumber + '&password=' + password;
            $("#login").addClass("disabled");
            $("#login").addClass("btn").removeClass("btn-primary");
            $('#login').attr('value', 'Logging In...');
            $.ajax({
                type: "POST",
                url: "login.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    $("#error").html(html);
                    $("#login").removeClass("disabled");
                    $("#login").addClass("btn-primary");
                    $('#login').attr('value', 'Log In');
                }
            });
        }
    });
	$('#pizzaform').validate({
        rules: {
            pepperoni: {
                minlength: 1,
                required: false,
                number: true
            },
            sausage: {
                minlength: 1,
                required: false,
                number: true
            },
			cheese: {
                minlength: 1,
                required: false,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function (element, errorClass, validClass) {
            $(element).parents('#pizzaform input[type=text]').removeClass('success');
            $(element).parents('#pizzaform input[type=text]').addClass('error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).parents('#pizzaform input[type=text]').removeClass('error');
            $(element).parents('#pizzaform input[type=text]').addClass('success');
        }   
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
            $(element).parents('.control-group').removeClass('success');
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
                url: "register.php",
                data: dataString,
                cache: false,
                success: function (html) {
                    $('#register').remove();
                    $(".modal-footer").append(html);
                }
            });
        }
    });
 	$('.well').height(function () {
        var h = _.max($(this).closest('.row').find('.well'), function (elem, index, list) {
            return $(elem).height();
        });
        return $(h).height();
    });
	$("#pizzaform input[type=text]").change(function () {
          var str = 0;
          $("#pizzaform input[type=text]").each(function () {
			if( !isNaN(parseInt($(this).val())))
                str += parseInt($(this).val(),10)*10;
              });
          $("#total").text(str);
        });
});
