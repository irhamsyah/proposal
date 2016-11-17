<div id="ajaxContent">
</div>

<script>
$('#ajaxContent').load('http://www.example.com/paginated/data');

$('.pagination a').on('click', function (event) {
    event.preventDefault();
    if ( $(this).attr('href') != '#' ) {
        $("html, body").animate({ scrollTop: 0 }, "fast");
        $('#ajaxContent').load($(this).attr('href'));
    }
});
</script>