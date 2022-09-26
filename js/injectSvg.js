// create new html custom class to fetch and inject external svg file
class ExtSVG extends HTMLElement {
    constructor() {
      super();
    }
    connectedCallback() {
      fetch(this.getAttribute('src'))
        .then(response => response.text())
        .then(text => {
          this.innerHTML = text;
        });
    }
  }

customElements.define('ext-svg', ExtSVG);
