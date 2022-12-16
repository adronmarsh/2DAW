class MySidebar2 extends HTMLElement {
    connectedCallback(){
        this.innerHTML = `
        <nav class="sidebar2">
        </nav>
        `
    }
}

customElements.define('my-sidebar2',MySidebar2)