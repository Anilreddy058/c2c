window.onload = function () {
    // Get the product data from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const product = {
       name: urlParams.get('name'),
       price: urlParams.get('price'),
       image: urlParams.get('image')
    };
 
    // Populate product details
    document.getElementById('product-name').innerText = product.name;
    document.getElementById('product-price').innerText = product.price;
    document.getElementById('product-img').src = product.image;
 
    // Update the product-data hidden input with image
    document.getElementById('product-data').value = JSON.stringify(product);
 
    // Show QR code for online payment
    document.getElementById('payment-mode').addEventListener('change', function () {
       const onlinePaymentDiv = document.getElementById('online-payment');
       if (this.value === 'online') {
          onlinePaymentDiv.style.display = 'block';
       } else {
          onlinePaymentDiv.style.display = 'none';
       }
    });
 }
 
 