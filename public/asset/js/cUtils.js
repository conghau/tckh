/**
 * Created by Tran Huu Nhan on 10/25/2014.
 */

$(document).ready(function(){
    /*********** utisl *****************/
    getUrlVars = function()
    {
        var vars = [], hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for(var i = 0; i < hashes.length; i++)
        {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    };

    remove_nonprintable = function(str)
    {
        //return str.replace(/[^A-Za-z 0-9 \.,\?""!@#\$%\^&\*\(\)-_=\+;:<>\/\\\|\}\{\[\]`~]*/g, '') ;
        return str.replace(/[\x00-\x1f]/g, '');
    };

    base64_encode_safe = function(input) {
        if ( !input || input == null || input == '' ) return '';

        var str = $.base64Encode(input);
        str = str.replace(/\+/g , '-');
        str = str.replace(/\//g , '_');
        str = str.replace(/=/g , ',');

        return str;
    };

    base64_decode_safe = function(input) {
        if ( !input || input == null || input == '' ) return null;

        var str = input.replace(/,/g , '=');
        str = input.replace(/_/g , '/');
        str = input.replace(/-/g , '+');

        return remove_nonprintable($.base64Decode(str));
    };

    dialog_route_action = function(dialog_title, url, dialog_id, dialog_width, dialog_heigh, refresh_when_close) {
        dialog_id = (typeof dialog_id === 'undefined') ? 'dialog_route_markup' : dialog_id;
        dialog_width = (typeof dialog_width === 'undefined') ? -1 : dialog_width;
        dialog_height = (typeof dialog_height === 'undefined') ? -1 : dialog_height;
        refresh_when_close = (typeof refresh_when_close === 'undefined') ? false : refresh_when_close;

        if ( refresh_when_close ) {
            toogle_overlay(true);
        }

        html = '<div class="modal fade" id="'+dialog_id+'" tabindex="-1" role="dialog" aria-labelledby="'+dialog_id+'_markupModalLabel" aria-hidden="true">'+
            '<div class="modal-dialog" id="'+dialog_id+'_dialog_inner_html">'+
                '<div class="modal-content">'+
                    '<div class="modal-header">'+
                        '<button type="button" id="'+dialog_id+'_close" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>'+
                        '<h3 class="modal-title clr-o" id="'+dialog_id+'_markupModalLabel">'+dialog_title+'</h3>'+
                    '</div>'+
                    '<div class="modal-body scroll oh" id="'+dialog_id+'_markup_content" style="overflow:hidden">'+
                        '<img src="'+wwwroot+'/asset/img/loading.png" align="absmiddle" />'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

        // add dialog to document
        $('body').append(html);
        // set width+height
        if ( dialog_width > 0 ) $('#'+dialog_id+'_dialog_inner_html').css('width', dialog_width+'px');
        if ( dialog_height > 0 ) $('#'+dialog_id+'_dialog_inner_html').css('height', dialog_height+'px');

        $('#'+dialog_id).on('show.bs.modal', function () {
            $('#'+dialog_id+'_dialog_inner_html').css({height: $(window).height(),'padding-top': 15, 'padding-bottom': 15});
        });
        $('#'+dialog_id).on('shown.bs.modal', function () {
            $('#'+dialog_id+'_markup_content').height($(window).height()-105).mCustomScrollbar({
                scrollButtons:{
                    enable:true
                },
                advanced: {
                    updateOnContentResize: true
            }});
        });
        $('#'+dialog_id).on('hidden.bs.modal', function (e) {
            $('#'+dialog_id).remove();
            if ( refresh_when_close ) {
                top.location.reload();
                //toogle_overlay(false);
            }
        });
        // show dialog
        $('#'+dialog_id).modal({});
        // load dialog content via AJAX
        $('#'+dialog_id+'_markup_content').html('<iframe id="'+dialog_id+'_iframe_content" src="'+url+'" scrolling="no" style="width:100%;border:0px;"></iframe>');

        // add iframe scroll
        /*$('#'+dialog_id+'_markup_content').mCustomScrollbar({
            scrollButtons:{
                enable:true
            },
            advanced: {
                updateOnContentResize: true
            }
        });*/
        $('#'+dialog_id+'_iframe_content').bind('load', function() {
            var iframe_content_height = $(this).contents().height() + 150;
            $(this).css('height', iframe_content_height+'px');

            //$(this).contents().find('body').css('background-image: url(asset/img/1x1.png)');

            var div_height = $('#'+dialog_id+'_markup_content').height();

            if ( div_height > iframe_content_height ) {
                $(this).css('height', (div_height-25)+'px');
            }
        });
    };

    dialog_route_choice_item = function(dialog_title, url, dialog_id, dialog_width, dialog_height, refresh_when_close) {
        dialog_id = (typeof dialog_id === 'undefined') ? 'dialog_route_markup' : dialog_id;
        dialog_width = (typeof dialog_width === 'undefined') ? -1 : dialog_width;
        dialog_height = (typeof dialog_height === 'undefined') ? -1 : dialog_height;
        refresh_when_close = (typeof refresh_when_close === 'undefined') ? false : refresh_when_close;

        if ( refresh_when_close ) {
            toogle_overlay(true);
        }

        html = '<div class="modal fade" id="'+dialog_id+'" tabindex="-1" role="dialog" aria-labelledby="'+dialog_id+'_markupModalLabel" aria-hidden="true">'+
            '<div class="modal-dialog" id="'+dialog_id+'_dialog_inner_html">'+
                '<div class="modal-content">'+
                    '<div class="modal-header">'+
                        '<button type="button" id="'+dialog_id+'_close" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>'+
                        '<h3 class="modal-title clr-o" id="'+dialog_id+'_markupModalLabel">'+dialog_title+'</h3>'+
                    '</div>'+
                    '<div class="modal-body" id="'+dialog_id+'_markup_content">'+
                        '<img src="'+wwwroot+'/asset/img/loading.png" align="absmiddle" />'+
                     '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

        // add dialog to document
        $('body').append(html);
        // set width+height
        if ( dialog_width > 0 ) $('#'+dialog_id+'_dialog_inner_html').css('width', dialog_width+'px');
        if ( dialog_height > 0 ) $('#'+dialog_id+'_dialog_inner_html').css('height', dialog_height+'px');
        $('#'+dialog_id+'_markup_content').css('overflow','auto');

        $('#'+dialog_id).on('hidden.bs.modal', function (e) {
            $('#'+dialog_id).remove();
            if ( refresh_when_close ) {
                location.reload();
                //toogle_overlay(false);
            }
        })
        // show dialog
        $('#'+dialog_id).modal({});
        // load dialog content via AJAX
        $('#'+dialog_id+'_markup_content').html('<iframe src="'+url+'" style="width:100%;height:'+($(window).height()-150)+'px;border:0px;"></iframe>');
    };

    /**
     * Load URL into modal content via AJAX
     * @param dialog_title
     * @param url
     * @param dialog_id
     * @param dialog_width
     * @param dialog_height
     */
    dialog_route = function(dialog_title, url, dialog_id, dialog_width, dialog_height) {
        dialog_id = (typeof dialog_id === 'undefined') ? 'dialog_route_markup' : dialog_id;
        dialog_width = (typeof dialog_width === 'undefined') ? -1 : dialog_width;
        dialog_height = (typeof dialog_height === 'undefined') ? -1 : dialog_height;

        html = '<div class="modal fade" id="'+dialog_id+'" tabindex="-1" role="dialog" aria-labelledby="'+dialog_id+'_markupModalLabel" aria-hidden="true">'+
            '<div class="modal-dialog" id="'+dialog_id+'_dialog_inner_html">'+
                '<div class="modal-content">'+
                    '<div class="modal-header">'+
                        '<button type="button" id="'+dialog_id+'_close" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Đóng</span></button>'+
                        '<h3 class="modal-title clr-o" id="'+dialog_id+'_markupModalLabel">'+dialog_title+'</h3>'+
                    '</div>'+
                    '<div class="modal-body" id="'+dialog_id+'_markup_content">'+
                        '<img src="'+wwwroot+'/asset/img/loading.png" align="absmiddle" />'+
                    '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

        if ( $('#'+dialog_id).length > 0 ) {
            $('#'+dialog_id+'_markup_content').html('<img src="'+wwwroot+'/asset/img/loading.png" align="absmiddle" />');
        }
        else {
            $('body').append(html);
        }
        // set width+height
        if ( dialog_width > 0 ) $('#'+dialog_id+'_dialog_inner_html').css('width', dialog_width+'px');
        if ( dialog_height > 0 ) $('#'+dialog_id+'_dialog_inner_html').css('height', dialog_height+'px');

        // show dialog
        $('#'+dialog_id).modal({});
        // load dialog content via AJAX
        $('#'+dialog_id+'_markup_content').load(url);
    };

    /**
     * Load URL to HTML element via AJAX
     * @param call_url
     * @param target_element
     * @param success_cb
     */
    ajax_html = function(call_url, target_element, success_cb) {
        $.ajax({
            type: 'GET',
            url: call_url,
            beforeSend: function() {
                $('#'+target_element).html('<img src="'+wwwroot+'/asset/img/loading.gif" align=""absmiddle" />')
            },
            error : function() {
                $('#'+target_element).html('Lỗi khi thực thi thao tác !!!');
            },
            success: function(response) {
                $('#'+target_element).html('');
                $('#'+target_element).html(response)

                if (typeof success_cb === 'undefined') { }
                else {
                    success_cb();
                }
            }
        });
    };

    /**
     * Toggle overlay for page
     * @param show
     */
    toogle_overlay = function(show) {
        show = (typeof show === 'undefined') ? true : show;

        var html = '<div id="woverlay" class="woverlay" style="display: none">'+
            '<div align="center" style="width:100%;padding-top:300px;"><img src="'+wwwroot+'/asset/img/loading.gif" /></div>'+
            '</div>';
        $('body').append(html);

        if ( show ) {
            $('#woverlay').css('width', $('body').width()+'px');
            $('#woverlay').css('height', $('body').height()+'px');
            $('#woverlay').show();
        }
        else {
            $('#woverlay').remove();
        }
    };

    /**
     * Append params to URL
     * @param url
     * @param params = Array([name=value, name=value,...])
     * @returns {*}
     */
    append_to_url = function(url, params) {
        if ( url.indexOf('?') >= 0 ) {
            for ( i=0; i<params.length; i++ ) {
                url += '&'+params[i];
            }
        }
        else {
            for ( i=0; i<params.length; i++ ) {
                if ( i==0 ) url += '?'+params[i];
                else url += '&'+params[i];
            }
        }
        return url;
    };

    loading = function(show, text) {
        show = (typeof show === 'undefined') ? false : show;
        text = (typeof text === 'undefined') ? '' : text;

        if ( text != '' ) {
            $('#statusbar-text').html(text);
        }

        if ( show ) $('#statusbar').show();
        else $('#statusbar').hide();
    };


});