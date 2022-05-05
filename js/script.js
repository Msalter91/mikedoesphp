function deleteItem(e) {
    e.preventDefault();
    var frm = $("<form>");
    frm.attr("method", "post");
    frm.attr("action", $(this).attr('href'));
    frm.appendTo("body");
    frm.submit();
};

$("a.deleteButton").on("click", deleteItem);

$("button.publish").on("click", function(e) {
    var id = $(this).data('id');
    var button = $(this);
    $.ajax({
      url: '/mikedoesphp/admin/publish_article.php',
      type: 'POST',
      data: {id: id}  
    })
    .done(function(data) {
        button.parent().html(data);
    })
});

$.validator.addMethod("dateTime", function (value, element) {
    return (value == "" || !isNaN(Date.parse(value)));
}, "Must be a valid date time");

$("#form-article").validate({
    rules: {
        title: {
            required: true
        },
        content: {
            required: true
        },
        published_at: {
            dateTime: true
        }
    }
}
);

$("#published_at").datetimepicker({
    format: "Y-m-d"
});

$("#contact-form").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        subject: {
            required: true
        },
        message: {
            required: true
        }
    }
})



