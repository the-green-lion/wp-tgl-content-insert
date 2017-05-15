var $spinner = jQuery(".self_service .spinner_container");
var $fields = jQuery(".self_service .field_container");

var $field_code = jQuery(".self_service #tgl_field_code");
var $button = jQuery(".self_service #tgl-login");

function getParameterByName(name, url) {
    if (!url) {
      url = window.location.href;
    }
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

jQuery().ready( function()
{
    var code = getParameterByName('code');
    if(!code || 0 === code.length)
    {
        // Not the right params provided. Show fields for manual input.
        $spinner.hide();
        $fields.show();

    } else {
        verifyDocument(code);
    }
});

jQuery(".self_service #tgl-login").click(function() {
    var code = $field_code.val();
    verifyDocument(code);
})

function verifyDocument(code) {
    $fields.hide();
    $spinner.show();

    // Load content to be displayed
    jQuery.ajax({
        type: "GET",
        url: "https://api.thegreenlion.net/selfservice/code/" + code + "/verify",
        crossDomain: true,
        success: function(html){
            jQuery(".self_service").html(html);
        },
        error: function(e){
            $spinner.hide();
            $fields.show();
        }
    });
}