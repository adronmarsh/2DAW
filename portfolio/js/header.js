class MyHeader extends HTMLElement {
    connectedCallback(){
        this.innerHTML = `
        <header class="header">
        <h1 class="border">Porfolio</h1>
        <h1 class="wave">Porfolio</h1>
        </header>
        `
    }
}

customElements.define('my-header',MyHeader)