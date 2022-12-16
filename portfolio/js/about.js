consoleText(['Sobre mí: <br><br>Soy un joven con mucha actitud y ambición. Aunque aún no tengo mucha experiencia profesional, estoy seguro de que puedo aportar mucho a una empresa. Estoy cursando el último año de Desarrollo de Aplicaciones WEB y estoy buscando una empresa para completar mis prácticas.<br><br>A lo largo de mi formación, he desarrollado habilidades en PHP, HTML, CSS, Java y JavaScript, y he realizado varios proyectos. También he tenido la oportunidad de adquirir experiencia laboral a través de prácticas de formación profesional en cursos anteriores.<br><br>En mi tiempo libre, me gusta programar y adquirir nuevos conocimientos, tanto en el ámbito informático como en otros campos. Me encanta aprender cosas nuevas y estoy constantemente buscando oportunidades para desarrollar mis habilidades y ampliar mis conocimientos.<br><br>Estoy buscando una oportunidad en una empresa donde pueda aprender y crecer profesionalmente. Creo que mi determinación y habilidades hacen de mí un candidato ideal para una posición en la que pueda desempeñarme. Si estás buscando a alguien como yo, no dudes en ponerte en contacto conmigo. Me encantaría tener la oportunidad de hablar contigo en persona y discutir cómo puedo contribuir al éxito de tu empresa.'], 'text', ['aqua']);

function consoleText(words, id, colors) {
    if (colors === undefined) colors = ['#fff'];
    var visible = true;
    var con = document.getElementById('console');
    var letterCount = 1;
    var x = 1;
    var waiting = false;
    var target = document.getElementById(id)
    target.setAttribute('style', 'color:' + colors[0])
    window.setInterval(function () {

        if (letterCount === 0 && waiting === false) {
            waiting = true;
            target.innerHTML = words[0].substring(0, letterCount)
            window.setTimeout(function () {
                var usedColor = colors.shift();
                colors.push(usedColor);
                var usedWord = words.shift();
                words.push(usedWord);
                x = 1;
                target.setAttribute('style', 'color:' + colors[0])
                letterCount += x;
                waiting = false;
            }, 10000)
        } else if (waiting === false) {
                target.innerHTML = words[0].substring(0, letterCount)
                letterCount += x;
            }
    }, 60)
    window.setInterval(function () {
        if (visible === true) {
            con.className = 'console-underscore hidden'
            visible = false;

        } else {
            con.className = 'console-underscore'

            visible = true;
        }
    }, 400)
}