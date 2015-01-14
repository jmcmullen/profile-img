<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Profile Picture Generator</title>
    </head>
    <body>
        <!-- Snap.svg Dependancy -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/snap.svg/0.3.0/snap.svg-min.js"></script>	

        <!-- Part 1: Create our variables -->
        <script>
            // This function read's url parameters.
            function gup(name) {
                name = name.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
                var regexS = "[\\?&]" + name + "=([^&#]*)";
                var regex = new RegExp(regexS);
                var results = regex.exec(window.location.href);
                if (results === null) {
                    return null;
                } else {
                    return results[1];
                }
            }
            
            // Get a colour.
            var colours = [
              "#f18f00",
              "#80ba27",
              "#0d93d2",
              "#e71e6c"
            ];
            var colour = colours[Math.ceil(Math.random()*3)];

            // Set the size of the image.
            var radius = 150;

            // Get the first letters of their first and last name.
            var names = gup("n").toUpperCase().split("%20");
            var name = names[0].charAt(0) + names[1].charAt(0) + "";
        </script>

        <!-- Part 2: Create the SVG images -->
        <script>
            // Draw the svg image.
            var s = Snap(radius * 4, radius * 4);
            var circle = s.circle(radius, radius, radius);
            var text = s.text(radius, radius + radius / 2.8, name);
            circle.attr({
                fill: colour
            });
            text.attr({
                "font-family": "Arial",
                "fill": "#fff",
                "font-size": radius + "px",
                "textAnchor": "middle"
            });
        </script>

        <!-- Part 2: Turn it into a PNG -->
        <script>
            // Convert the svg image to a png format.
            var svg = document.querySelector("svg");
            var svgData = new XMLSerializer().serializeToString(svg);
            
            var canvas = document.createElement("canvas");
            canvas.width = window.innerWidth;
            canvas.height = window.innerHeight;
            
            var ctx = canvas.getContext("2d");
            var img = document.createElement("img");
            
            img.setAttribute("src", "data:image/svg+xml;base64," + btoa(svgData));

            // Render the image client side.
            img.onload = function() {
                ctx.drawImage(img, 0, 0);
                window.location.href = canvas.toDataURL("image/png");
            };
        </script>
</html>
