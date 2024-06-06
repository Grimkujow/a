<div id="canvas-container">
    <canvas id="drawingCanvas" width="700" height="500"></canvas>
</div>
    <div id="colors">
        <button class="color" data-color="black"></button>
        <button class="color" data-color="red"></button>
        <button class="color" data-color="green"></button>
        <button class="color" data-color="blue"></button>
        <button class="color" data-color="yellow"></button>
        <button class="color" data-color="orange"></button>
        <button class="color" data-color="purple"></button>
        <button class="color" data-color="cyan"></button>
        <button class="color" data-color="magenta"></button>
        <button class="color" data-color="brown"></button>
        <button id="eraserButton">
            <img src="/eraser4.png" alt="Gomme class="gomme-img">
        </button>&nbsp;&nbsp;
        <button id="clearButton">Effacer</button>
        <input type="range" id="thicknessRange" min="1" max="15" value="3">
        <form action="save_image.php" method="post" enctype="multipart/form-data">
            <button id="saveButton">Sauvegarder le dessin</button>
            <input type="hidden" name="imageData" id="imageData">
        </form>
    </div>
</div>
<script>
    // JavaScript pour dessiner sur le canvas
    document.addEventListener('DOMContentLoaded', function() {
        var canvas = document.getElementById('drawingCanvas');
        var context = canvas.getContext('2d');

        // pour l'enregistrement du dessin
        var form = document.querySelector('form');
        form.addEventListener('submit', function(event) {
            var imageData = canvas.toDataURL();
            document.getElementById('imageData').value = imageData;
        });

        var isDrawing = false;
        var lastX = 0;
        var lastY = 0;
        var currentColor = 'black';
        var thickness = 3;

        canvas.addEventListener('mousedown', function(e) {
            isDrawing = true;
            [lastX, lastY] = [e.offsetX, e.offsetY];
        });

        canvas.addEventListener('mousemove', function(e) {
            if (isDrawing) {
                context.strokeStyle = currentColor;
                context.lineWidth = thickness;
                context.lineCap = 'round';
                context.beginPath();
                context.moveTo(lastX, lastY);
                context.lineTo(e.offsetX, e.offsetY);
                context.stroke();
                [lastX, lastY] = [e.offsetX, e.offsetY];
            }
        });

        canvas.addEventListener('mouseup', function() {
            isDrawing = false;
        });

        canvas.addEventListener('mouseout', function() {
            isDrawing = false;
        });

        var colorButtons = document.querySelectorAll('.color');
        colorButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                currentColor = this.dataset.color; // Récupère la couleur à partir de l'attribut data-color
            });
        });

        var eraserButton = document.getElementById('eraserButton');
        eraserButton.addEventListener('click', function() {
            currentColor = 'white'; // Change la couleur pour la gomme (blanc)
        });

        var thicknessRange = document.getElementById('thicknessRange');
        thicknessRange.addEventListener('input', function() {
            thickness = parseInt(this.value); 
        });

        var clearButton = document.getElementById('clearButton');
        clearButton.addEventListener('click', function() {
            context.clearRect(0, 0, canvas.width, canvas.height); // Efface tout le contenu du canvas
        });
    });
</script>
