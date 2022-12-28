class MyFooter extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
        <footer class="footer">
        Adrián Martínez Gil
        </footer>
        `
    }
}

customElements.define('my-footer', MyFooter)