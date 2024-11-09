document.addEventListener('DOMContentLoaded', () => {
    const cartItemsContainer = document.getElementById('cart-items-container');
    const totalPriceElement = document.getElementById('total-price');
    let totalPrice = 0;

    const cartItems = JSON.parse(localStorage.getItem('cart')) || [];

    function renderCartItems() {
        cartItemsContainer.innerHTML = '';
        totalPrice = 0;

        cartItems.forEach((item, index) => {
            const cartItem = document.createElement('div');
            cartItem.className = 'cart-item';
            
            cartItem.innerHTML = `
                <img src="${item.image}" alt="${item.name}">
                <h3>${item.name}</h3>
                <p>₹${(item.price / item.quantity).toFixed(2)}</p>
                <div class="quantity">
                    <button onclick="decreaseQuantity(${index})">-</button>
                    <input type="text" value="${item.quantity}" readonly>
                    <button onclick="increaseQuantity(${index})">+</button>
                </div>
                <button class="remove-btn" onclick="removeFromCart(${index})">Remove</button>
            `;

            cartItemsContainer.appendChild(cartItem);
            totalPrice += item.price;
        });

        totalPriceElement.textContent = `₹${totalPrice.toFixed(2)}`;
    }

    window.increaseQuantity = function(index) {
        cartItems[index].quantity += 1;
        cartItems[index].price += cartItems[index].price / (cartItems[index].quantity - 1);
        localStorage.setItem('cart', JSON.stringify(cartItems));
        renderCartItems();
    };

    window.decreaseQuantity = function(index) {
        if (cartItems[index].quantity > 1) {
            cartItems[index].price -= cartItems[index].price / cartItems[index].quantity;
            cartItems[index].quantity -= 1;
            localStorage.setItem('cart', JSON.stringify(cartItems));
            renderCartItems();
        }
    };

    window.removeFromCart = function(index) {
        cartItems.splice(index, 1);
        localStorage.setItem('cart', JSON.stringify(cartItems));
        renderCartItems();
    };

    renderCartItems();
});

