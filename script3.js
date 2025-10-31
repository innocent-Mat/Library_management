document.addEventListener('DOMContentLoaded', function() {  
    const addToCartButtons = document.querySelectorAll('.add-to-cart');  

    addToCartButtons.forEach(button => {  
        button.addEventListener('click', function() {  
            const bookData = {  
                title: this.dataset.title,  
                author: this.dataset.author,  
                price: this.dataset.price,  
                image_url: this.dataset.image  
            };  

            fetch('add_to_cart.php', {  
                method: 'POST',  
                headers: {  
                    'Content-Type': 'application/json'  
                },  
                body: JSON.stringify(bookData)  
            })  
            .then(response => response.json())  
            .then(data => {  
                if (data.success) {  
                    alert('Book added to cart!');  
                } else {  
                    alert('Error adding book: ' + data.message);  
                }  
            })  
            .catch(error => {  
                console.error('Error:', error);  
                alert('Network error. Check console.');  
            });  
        });  
    });  
});  