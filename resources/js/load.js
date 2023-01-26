$(document).ready(function (){
    $(document).on
    ('click', '.pagination_link',
        function ()
        {
            let $pageNumber = $(this).attr("id");
            load_data($pageNumber,switcher);
        }
    );
    $(document).on('click', '.form-check-input',
        function ()
        {
            switcher = $(this).attr("id");
            load_data($pageNumber,switcher);
        }
    );

    load_data();
    let switcher = 'all';
    let $pageNumber = '1';
    function load_data($pageNumber,switcher)
    {
        $.ajax
        ({
            url:"./view/ShowContent.php",
            method:"POST",
            data:{$pageNumber:$pageNumber, switcher:switcher},
            success:function (data){
                $('#paginationData').html(data);
            }
        })
    }

});
