var MSG_DIRECTION_FROM = 'from';
var MSG_DIRECTION_TO = 'to';
var MSG_LISTMSG_RETURN_DATATYPE_HTML = 'html';
var MSG_LISTMSG_RETURN_DATATYPE_JSON = 'json';
var MSGTYPE_NORMAL = 'normal';
var MSGTYPE_NOTIFY = 'notify';

$(document).ready(function() {

    /* ham tien ich cho message */
    /**
     * Hiển thị form gởi tin nhắn
     */
    msg_show_createmsg_form = function (replyinfo) {
        replyinfo = (typeof replyinfo === 'undefined') ? '' : '&rep='+replyinfo;

        loading(true);
        if ($('#msg_createmsg_form').length <= 0) {
            var html_createmsg_form = '<div id="msg_createmsg_form" style="position:fixed;right:5px;bottom:0px;width:550px;height:452px;"></div>';
            $(document).contents().append(html_createmsg_form);
        }
        $.ajax({
            type: 'GET',
            url: wwwroot + '/messages/createmsg?blank=true'+replyinfo,
            beforeSend: function () {
            },
            error: function () {
                if ( $('#msg_createmsg_form').length > 0 ) $('#msg_createmsg_form').remove();
                loading(false);
                bootbox.alert('Lỗi khi tạo form gởi tin nhắn !!!');
            },
            success: function (response) {
                loading(false);
                $('#msg_createmsg_form').html(response);
            }
        });
    };

    /**
     * Đóng form gởi tin nhắn
     */
    msg_close_createmsg_form = function () {
        if ($('#msg_createmsg_form').length > 0) {
            $('#msg_createmsg_form').fadeOut('slow', function () {
                $(this).remove();
            });
        }
    };

    /**
     * Lấy danh sách tin nhắn
     *
     * @param msg_direction (from/to)
     * @param return_datatype   (html/json)
     * @param complete_cb   function callback after request complete
     */
    msg_listmsg = function (msg_direction, return_datatype, complete_cb) {
        if (return_datatype == MSG_LISTMSG_RETURN_DATATYPE_HTML) {
        }
        else if (return_datatype == MSG_LISTMSG_RETURN_DATATYPE_JSON) {
        }
        else {
            bootbox.alert('Return data type incorrect !!!');
            return;
        }

        $.ajax({
            type: 'GET',
            url: wwwroot + '/messages/listmsg?direction=' + msg_direction + '&rettype=' + return_datatype + '&blank=true',
            beforeSend: function () {
            },
            error: function () {
                loading(false);
                bootbox.alert('Lỗi khi lấy tin nhắn !!!');
            },
            success: function (response) {
                complete_cb(response);
            },
            dataType: return_datatype
        });
    };

    /**
     * Lấy danh sách tin nhắn (bằng URL)
     *
     * @param url   (url cần lấy)
     * @param complete_cb   function callback after request complete
     */
    msg_listmsg_from_url = function (url, complete_cb) {
        loading(true);

        var urls = getUrlVars(url);

        $.ajax({
            type: 'GET',
            url: url,
            beforeSend: function () {
            },
            error: function () {
                loading(false);
                bootbox.alert('Lỗi khi lấy tin nhắn !!!');
            },
            success: function (response) {
                loading(false);

                complete_cb(response);
            },
            dataType: urls['rettype']
        });
    };

    msg_deletemsg = function (msgids, msg_direction, complete_cb) {
        loading(true);
        $.ajax({
            type: 'GET',
            url: wwwroot + '/messages/deletemsg?ids=' + msgids + '&blank=true&direction=' + msg_direction,
            beforeSend: function () {
            },
            error: function () {
                loading(false);
                bootbox.alert('Lỗi khi xóa tin nhắn !!!');
            },
            success: function (response) {
                loading(false);

                complete_cb(response);
            },
            dataType: 'json'
        });
    };

    msg_showmsg = function(msgid, msg_direction, complete_cb) {
        loading(true);
        $.ajax({
            type: 'GET',
            url: wwwroot + '/messages/showmsg?id=' + msgid + '&blank=true&direction='+msg_direction,
            beforeSend: function () {
            },
            error: function () {
                loading(false);
                bootbox.alert('Lỗi khi xem tin nhắn !!!');
            },
            success: function (response) {
                loading(false);

                complete_cb(response);
            },
            dataType: 'json'
        });
    };

    msg_countunread_msg = function(complete_cb) {
        $.ajax({
            type: 'GET',
            url: wwwroot + '/messages/countunreadmsg',
            beforeSend: function () {
            },
            error: function () {
                bootbox.alert('Lỗi khi xem lấy số lượng tin nhắn chưa xem !!!');
            },
            success: function (response) {
                if ( response ) {
                    if ( response.status == 0 ) {
                        complete_cb(response);
                    }
                    else {
                        bootbox.alert('Lỗi khi lấy thông tin số lượng tin nhắn chưa xem !!!');
                    }
                }
                else {
                    bootbox.alert('Response is null');
                }
            },
            dataType: 'json'
        });
    };
});