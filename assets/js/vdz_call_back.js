/*
 *
 *  * @ author ( Zikiy Vadim )
 *  * @ site http://online-services.org.ua
 *  * @ name
 *  * @ copyright Copyright (C) 2016 All rights reserved.
 *
 */
(function($){
    $(document).ready(function(){

        //Add NEW popup
        if(window.jBox){
            new jBox('Modal', {
                // width: 300,
                // height: 200,
                attach: '.vdz_cb_btn, .vdz_cb_widget_btn',
                //title: 'My Modal Window',
                //content: 'TEST',
                content: $('#vdz_cb'),
            });
        }

        var $vdz_cb_phone = $("#vdz_cb_phone");
        //Add Mask
        var vdz_cb_phone_mask = $vdz_cb_phone.data('mask') || "(999) 999-99-99";
        if(($vdz_cb_phone.data('mask_off') == undefined) || ($vdz_cb_phone.data('mask_off') == 'on')){
            $("#vdz_cb_phone").mask(vdz_cb_phone_mask);
        }

        //Add International code
//        $("#vdz_cb_phone").intlTelInput({
//            initialCountry: "auto",
//            geoIpLookup: function(callback) {
//              $.get('http://ipinfo.io', function() {}, "jsonp").always(function(resp) {
//                var countryCode = (resp && resp.country) ? resp.country : "";
//                callback(countryCode);
//              });
//            },
//            utilsScript: "<?//=VDZ_CB_URL?>//assets/int_tel_input/js/utils.js" // just for formatting/placeholders etc
//          });

        //Add ajax form submit
        $('#vdz_cb_form').on('submit', function(e){
            e.preventDefault();
            $('#vdz_cb_unsver div').hide();
//              $("#full_phone").val($("#vdz_cb_phone").intlTelInput("getNumber"));
            $.ajax({
                type: 'POST',
                url: window.vdz_cb.ajax_url,
                data: $(this).serialize(),
                success: function (response) {
                    var content = $.parseJSON(response);
//                            console.log(content);
                    if (content.status == 'success')
                    {
                        $("#vdz_cb_form").trigger( 'reset' ).slideUp();
                        $('#vdz_cb_unsver .success').show();

                        //ADD Events to Google Analytics
                        var obj_form = {
                            hitType: 'event',
                            eventCategory: 'VDZ_Callback',
                            eventAction: 'Send',
                            eventLabel: 'Send_VDZ_Callback',
                        };
                        var send = false;
                        if(window.gtag){
                            gtag('event', obj_form.eventAction, { 'event_category': obj_form.eventCategory, 'event_action': obj_form.eventAction, 'event_label': obj_form.eventLabel});
                            //console.log('GTAG send = ',obj_form);
                            send = true;
                        }
                        if(!send){
                            if(window.ga){
                                ga('send', obj_form);
                                //console.log('GA send = ',obj_form);
                                send = true;
                            }
                        }
                    }else{
                        $('#vdz_cb_unsver .warning').show();
                    }
                },
                error: function( data, textStatus, jqXHR ){
//                            console.log('data:');
//                            console.log(data);
//                            console.log('textStatus:');
//                            console.log(textStatus);
//                            console.log('jqXHR:');
//                            console.log(jqXHR);
                    $('#vdz_cb_unsver .warning').show();
                }
            })
        });


    });
})(jQuery);

