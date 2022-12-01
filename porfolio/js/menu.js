class MyMenu extends HTMLElement {
    connectedCallback(){
        this.innerHTML = `
        <nav class="sidebar">
            <ul class="menu">
                <li><a href="index.html">inicio</a></li>
                <li><a href="#!">sobre mi</a></li>
                <li><a href="skills.html">skills</a></li>
                <li><a href="#!">proyectos</a></li>
                <li><a href="#!">contacto</a></li>
                <li><a href="#!">github</a></li>
            </ul>
        </nav>
        `
    }
}

customElements.define('my-menu',MyMenu)

