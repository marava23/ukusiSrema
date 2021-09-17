const cartBtn = document.querySelector(".cart-btn");
const closeCartBtn = document.querySelector(".close-cart");
const clearCartBtn = document.querySelector(".clear-cart");
const cartDOM = document.querySelector(".cart");
const cartOverlay = document.querySelector(".cart-overlay");
const cartItems = document.querySelector(".cart-items");
const cartTotal = document.querySelector(".cart-total");
const cartContent = document.querySelector(".cart-content");
const productsDOM = document.querySelector(".products-center");

let cart = [];
let buttonsDOM = [];

class Products {
    async getProducts() {
        try {
            let result = await fetch("models/proizvodi/dohvatiSve.php");
            let data = await result.json();
            return data;
        } catch (error) {
            console.log(error);
        }
    }
}
class UI {
    displayProducts(products) {
        let html="";
        for(let p of products){
            html+=`<div class='proizvodi'>
                    <article class='proizvod'>
                        <div class='img-container'>
                            <img src='assets/img/${p.malaputanja}' alt='${p.alt}'>
                            <div class='infromacije'>
                                <h3>${p.NazivProizvoda} - ${p.Iznos}rsd/kg</h3>
                                <a href='index.php?page=proizvod&id=${p.id}'><button>Prikaži više </button></a>
                                <button class='bag-btn' data-id='${p.id}'>Dodaj u korpu </button>
                            </div>
                        </div>
                    </article>
                </div>`;
        }
        if(html.length==0){
            $("#proizvodi").html("Nema proizvoda za prikaz!");
        }
        else{
            $("#proizvodi").html(html);
        }
    }
    getBagButtons() {
        const buttons = [...document.querySelectorAll(".bag-btn")];
        buttonsDOM = buttons;
        buttons.forEach(button => {
            let id = button.dataset.id;
            let inCart = cart.find(item => item.id === id);
            if (inCart) {
                //console.log('usao je ovde');
                button.innerText = "U korpi";
                button.disabled = true;
            }
            button.addEventListener("click", event => {
                event.target.innerText = "U korpi";
                event.target.disabled = true;
                let cartItem = { ...Storage.getProduct(id), amount: 1 };
                cart = [...cart, cartItem];
                Storage.saveCart(cart);
                this.setCartValues(cart);
                this.addCartItem(cartItem);
                this.showCart();
            });
        });
    }
    setCartValues(cart) {
        let tempTotal = 0;
        let itemsTotal = 0;
        cart.map(item => {
            tempTotal += item.Iznos * item.amount;
            itemsTotal += item.amount;
        });
        cartTotal.innerText = parseFloat(tempTotal.toFixed(2)) + "rsd";
        cartItems.innerText = itemsTotal ;
    }
    addCartItem(item) {
        //console.log(item);
        const div = document.createElement("div");
        div.classList.add("cart-item");
        div.innerHTML = `<img src='assets/img/${item.malaputanja}' alt="product" />
              <div>
                <h4>${item.NazivProizvoda}</h4>
                <h5>${item.Iznos} rsd/kg </h5>
                <span class="remove-item" data-id=${item.id}>ukloni</span>
              </div>
              <div>
                <i class="fas fa-chevron-up" data-id=${item.id}></i>
                <p class="item-amount">${item.amount} </p>
                <i class="fas fa-chevron-down" data-id=${item.id}></i>
              </div>`;
        cartContent.appendChild(div);
    }
    showCart() {
        cartOverlay.classList.add("transparentBcg");
        cartDOM.classList.add("showCart");
    }
    setupAPP() {
        cart = Storage.getCart();
        this.setCartValues(cart);
        this.populateCart(cart);
        cartBtn.addEventListener("click", this.showCart);
        closeCartBtn.addEventListener("click", this.hideCart);
    }
    populateCart(cart) {
        cart.forEach(item => this.addCartItem(item));
    }
    hideCart() {
        cartOverlay.classList.remove("transparentBcg");
        cartDOM.classList.remove("showCart");
    }
    cartLogic() {

        clearCartBtn.addEventListener("click", () => {
            this.clearCart();
        });

        cartContent.addEventListener("click", event => {
            if (event.target.classList.contains("remove-item")) {
                let removeItem = event.target;
                let id = removeItem.dataset.id;
                cartContent.removeChild(removeItem.parentElement.parentElement);
                this.removeItem(id);
            } else if (event.target.classList.contains("fa-chevron-up")) {
                let addAmount = event.target;
                let id = addAmount.dataset.id;
                let tempItem = cart.find(item => item.id === id);
                tempItem.amount = tempItem.amount + 1;
                Storage.saveCart(cart);
                this.setCartValues(cart);
                addAmount.nextElementSibling.innerText = tempItem.amount;
            } else if (event.target.classList.contains("fa-chevron-down")) {
                let lowerAmount = event.target;
                let id = lowerAmount.dataset.id;
                let tempItem = cart.find(item => item.id === id);
                tempItem.amount = tempItem.amount - 1;
                if (tempItem.amount > 0) {
                    Storage.saveCart(cart);
                    this.setCartValues(cart);
                    lowerAmount.previousElementSibling.innerText = tempItem.amount;
                } else {
                    cartContent.removeChild(lowerAmount.parentElement.parentElement);
                    this.removeItem(id);
                }
            }
        });
    }
    clearCart() {
        let cartItems = cart.map(item => item.id);
        cartItems.forEach(id => this.removeItem(id));
        console.log(cartContent.children);

        while (cartContent.children.length > 0) {
            cartContent.removeChild(cartContent.children[0]);
        }
        //this.hideCart();
    }
    removeItem(id) {
        console.log(id);
        //console.log(cart);
        cart = cart.filter(item => item.id !== id);
        //console.log(cart);
        this.setCartValues(cart);
        Storage.saveCart(cart);
        let button = this.getSingleButton(id);
        button.disabled = false;
        button.innerHTML = `Dodaj u korpu`;
    }
    getSingleButton(id) {
        return buttonsDOM.find(button => button.dataset.id === id);
    }
}

class Storage {
    static saveProducts(products) {
        localStorage.setItem("products", JSON.stringify(products));
    }
    static getProduct(id) {
        let products = JSON.parse(localStorage.getItem("products"));
        return products.find(product => product.id === id);
    }
    static saveCart(cart) {
        localStorage.setItem("cart", JSON.stringify(cart));
    }
    static getCart() {
        return localStorage.getItem("cart")
            ? JSON.parse(localStorage.getItem("cart"))
            : [];
    }
}
    document.addEventListener("DOMContentLoaded", () => {
        const ui = new UI();
        const products = new Products();
        ui.setupAPP();
        products
            .getProducts()
            .then(products => {
                ui.displayProducts(products);
                Storage.saveProducts(products);
            })
            .then(() => {
                ui.getBagButtons();
                ui.cartLogic();
            });
        $('#kupi').click(obaviKupovinu);
    });
function obaviKupovinu(){
    korpa = Storage.getCart();
    console.log(korpa);
    let kupac = $('#kupacId').val();
    let ukCena = $(".cart-total")[0].innerHTML.slice(0,-3);
    let idProizvoda = [];
    let kolicina = [];
    let cena = [];
    for(let i=0; i<korpa.length; i++){
        idProizvoda.push(korpa[i].id);
        kolicina.push(korpa[i].amount);
        cena.push(parseFloat(korpa[i].Iznos));
    }
    console.log(idProizvoda, kolicina, cena);
    if(korpa.length!=0) {
        $.ajax({
            method: "post",
            url: "models/kupovina/dodaj.php",
            data: {
                idKorisnika : kupac,
                ukupnaCena : ukCena,
                proizvodi : idProizvoda,
                kolicine : kolicina,
                cene : cena
            },
            dataType: "json",
            success: function (uspeh) {
                if(uspeh.poruka == "Registracija"){
                    location.replace("index.php?page=registracija");
                }
                if(uspeh.poruka=="Porudzbina je uspesno poslata!"){
                    let cimra = new UI();
                    cimra.clearCart();
                    $("#kupovinaGreska").html("Porudzbina je poslata!")
                }
                console.log(uspeh.poruka);
            },
            error: function (xhr) {
                console.log(xhr);
            }
        });
    }
    else{
        $("#kupovinaGreska").html("Korpa je prazna!")
    }
}