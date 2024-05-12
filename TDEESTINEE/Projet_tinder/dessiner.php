<h3>Dessinez ici</h3>
<div id="canvas-container">
    <canvas id="drawingCanvas" width="500" height="300"></canvas>
</div>

<div id="colors">
    <button class="color" data-color="black"></button>
    <button class="color" data-color="red"></button>
    <button class="color" data-color="green"></button>
    <button class="color" data-color="blue"></button>
    <button id="eraserButton">Gomme</button>
    <button id="clearButton">Effacer</button>
    <input type="range" id="thicknessRange" min="1" max="15" value="3">
</div>

<script>
    // JavaScript pour dessiner sur le canvas
    document.addEventListener('DOMContentLoaded', function() {
        var canvas = document.getElementById('drawingCanvas');
        var context = canvas.getContext('2d');

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
            thickness = parseInt(this.value); // Met à jour l'épaisseur du trait
        });

        var clearButton = document.getElementById('clearButton');
        clearButton.addEventListener('click', function() {
            context.clearRect(0, 0, canvas.width, canvas.height); // Efface tout le contenu du canevas
        });
    });
</script>
