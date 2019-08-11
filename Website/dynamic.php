<html>
    <head>
        <!-- Include Jquery here in a script tag -->
        <script type="text/javascript">
            $(document).ready(function(){
                 $("#activities").click(function(){
                     $("#body").load("activities.html");
                 });
            });
        </script>
    </head>
    <body>
        <div id="header">
            <a href="#" id="activities">Activities</a>
            <!-- this stays the same -->
        </div>
        <div id="body">

            <!-- All content will be loaded here dynamically -->

        </div>
        <div id="footer">
            <!-- this stays the same -->
        </div>
    </body>
</html>