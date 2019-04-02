var faker = require('faker');

for(var i = 0; i < 10; i++) {
    var prodName = faker.commerce.productName();
    var price = faker.commerce.price();
    console.log(prodName + " - $" + price);
}