function search_medicine(url) {
    $(document).on("keyup", "input[name='search_medicine']", function() {
        let value = $(this).val();
        if (value !== ""){
            $.ajax({
                url:url,
                method: 'get',
                data:{
                    name:value
                },success:function (result) {

                }
            });
        }

    });
}
