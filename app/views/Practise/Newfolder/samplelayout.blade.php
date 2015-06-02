<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
        <meta charset="utf-8">
        <script src="/nlab.com/js/jquery.js"></script> 
        <script src="/nlab.com/js/jquery.steps.js"></script>
        <script src="  https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.1.4/jquery.bootgrid.min.js"></script>
      
        <link rel="stylesheet" href=" https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.1.4/jquery.bootgrid.css" type="text/css"/>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-bootgrid/1.1.4/jquery.bootgrid.min.css" type="text/css"/>
         
    </head>
    <body>
        <div id="example-basic">
    <h3>Keyboard</h3>
    <section>
        <p>Try the keyboard navigation by clicking arrow left or right!</p>
    </section>
    <h3>Effects</h3>
    <section>
        <p>Wonderful transition effects.</p>
    </section>
    <h3>Pager</h3>
    <section>
        <p>The next and previous buttons help you to navigate through your content.</p>
    </section>
</div>
    </body>
</html>





<script>
$("#example-basic").steps({
    headerTag: "h3",
    bodyTag: "section",
    transitionEffect: "slideLeft",
    autoFocus: true
});

</script>