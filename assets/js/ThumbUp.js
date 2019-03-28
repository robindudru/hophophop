class ThumbUp {
    constructor() {
        this.ajaxRequest();
        console.log('constructed');
    }

    ajaxRequest() {
        $(document).on('click', '.fa-thumbs-up', () => {
            console.log('click');
            that = $(this);
            $.ajax({
                type: "POST",
                dataType: "json",
                data: {
                    "newThumbsUp": '+1'
                },
                async: true,
                success: function (data)
                {
                    console.log(data)
                    $('.thumbs-up-number').html(data.output);

                }
            });
            return false;
        });
    }
}

var thumbUp = new ThumbUp();